<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    private const CACHE_PREFIX_FOR_ALL_USERS = 'users:all';
    private const CACHE_PREFIX_FOR_ONE_USER = 'users:single:';
    private const CACHE_TTL = 1440; // 60 * 24, сутки

    public function __construct(
        protected User $user
    )
    {
    }

    public function findUserById(int $userId): ?User
    {
        $cacheKey = self::CACHE_PREFIX_FOR_ONE_USER . $userId;

        return Cache::tags(['users'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn() => $this->user->with('role')->find($userId)
        );
    }

    public function getUsersCount(): int
    {
        return Cache::tags(['users'])->remember(
            'users:count',
            self::CACHE_TTL,
            fn() => $this->user->count()
        );
    }


    public function getFilterableUsers(array $data): LengthAwarePaginator
    {
        return $this->user
            ->filter($data)
            ->with('role')
            ->paginate(10)
            ->withQueryString();
    }

    public function getPaginatedUsers(): LengthAwarePaginator
    {
        $perPage = 10;
        $page = (int)request()->get('page', 1);

        $users = Cache::tags(['users'])->remember(
            self::CACHE_PREFIX_FOR_ALL_USERS,
            self::CACHE_TTL,
            fn() => $this->user
                ->with(['role', 'ovd'])
                ->orderByDesc('created_at')
                ->get()
        );

        $paged = $users->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paged->values(),
            $users->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    public function createUser(array $userData): ?User
    {
        return DB::transaction(function () use ($userData) {
            $user = $this->user->create($userData);
            $this->clearUserCache($user->id);
            return $user;
        });
    }

    public function updateUser(int $userId, array $userData): ?User
    {
        return DB::transaction(function () use ($userId, $userData) {
            $user = $this->user->find($userId);
            if (!$user) {
                return null;
            }

            if (empty($userData['password'])) {
                unset($userData['password']);
            }

            $updated = $user->update($userData);

            if ($updated) {
                $this->clearUserCache($user->id);
                return $user;
            }

            return null;
        });
    }

    public function deleteUser(int $userId): bool
    {
        return DB::transaction(function () use ($userId) {
            $user = $this->user->find($userId);

            if (!$user) {
                return false;
            }

            $deleted = $user->delete();
            if ($deleted) {
                $this->clearUserCache($userId);
            }

            return $deleted;
        });
    }

    protected function clearUserCache(int $userId): void
    {
        Cache::tags(['users'])->flush();
        Cache::forget(self::CACHE_PREFIX_FOR_ONE_USER . $userId);
        Cache::forget('users:count');
    }
}
