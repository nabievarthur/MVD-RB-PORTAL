<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    private const CACHE_PREFIX_USER = 'user:';

    private const CACHE_PREFIX_COUNT = 'users:count';

    private const CACHE_TTL = 1440; // 60 * 24, сутки

    public function findUserById(int $userId): ?User
    {
        $cacheKey = self::CACHE_PREFIX_USER.$userId;

        return Cache::tags(['users'])->remember(
            $cacheKey,
            self::CACHE_TTL,
            fn () => User::with('role')->find($userId)
        );
    }

    public function getUsersCount(): int
    {
        return Cache::tags(['users'])->remember(
            self::CACHE_PREFIX_COUNT,
            self::CACHE_TTL,
            fn () => User::count()
        );
    }

    public function getFilterableUsers(array $filters): LengthAwarePaginator
    {
        return User::filter($filters)
            ->with('role')
            ->paginate(10)
            ->withQueryString();
    }

    public function getPaginatedUsers(int $perPage = 10, int $page = 1): LengthAwarePaginator
    {
        return User::with(['role', 'ovd'])
            ->orderByDesc('created_at')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function createUser(array $userData): ?User
    {
        return DB::transaction(function () use ($userData) {
            $user = User::create($userData);
            if ($user) {
                $this->clearUserCache($user->id);
            }

            return $user;
        });
    }

    public function updateUser(int $userId, array $userData): ?User
    {
        return DB::transaction(function () use ($userId, $userData) {
            $user = User::find($userId);
            if (! $user) {
                return null;
            }
            $updated = $user->update($userData);

            if ($updated) {
                $this->clearUserCache($userId);

                return $user->fresh();
            }

            return null;
        });
    }

    public function deleteUser(int $userId): bool
    {
        return DB::transaction(function () use ($userId) {
            $user = User::find($userId);
            if (! $user) {
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
        Cache::tags(['users'])->forget(self::CACHE_PREFIX_USER.$userId);
        Cache::tags(['users'])->forget(self::CACHE_PREFIX_COUNT);
    }
}
