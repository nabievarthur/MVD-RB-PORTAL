<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    const CACHE_PREFIX_FOR_ALL_USERS = 'users:all';
    const CACHE_PREFIX_FOR_ONE_USER = 'users:single';
    const CACHE_TTL = 60 * 24; //Сутки

    public function __construct(protected User $user)
    {
    }

    public function findUserById(int $userId): ?User
    {
        return Cache::remember(
            self::CACHE_PREFIX_FOR_ONE_USER . $userId,
            self::CACHE_TTL,
            fn() => $this->user->with('role')->find($userId)
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
        $page = request()->get('page', 1);

        $users = Cache::tags(['users'])->remember(
            self::CACHE_PREFIX_FOR_ALL_USERS,
            self::CACHE_TTL,
            fn() => $this->user
                ->with(['role', 'ovd'])
                ->orderBy('created_at', 'desc')
                ->get()
        );

        $paged = $users->forPage($page, $perPage);

        return new LengthAwarePaginator(
            $paged,
            $users->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function createUser(array $userData): ?User
    {
        $user = $this->user->create([
            'login' => $userData['login'],
            'password' => Hash::make($userData['password']),
            'last_name' => $userData['last_name'],
            'first_name' => $userData['first_name'],
            'surname' => $userData['surname'],
            'ovd_id' => $userData['ovd_id'],
            'subdivision_id' => $userData['subdivision_id'],
            'role_id' => $userData['role_id'],
        ]);

        $this->clearUserCache($user->id);

        return $user;
    }

    public function updateUser(int $userId, array $userData): ?User
    {
        $user = $this->findUserById($userId);

        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        if (!$user || !$user->update($userData)) {
            return null;
        }

        $this->clearUserCache($user->id);

        return $user;
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->findUserById($userId);

        if (!$user || !$user->delete()) {
            return false;
        }

        $this->clearUserCache($userId);

        return true;
    }

    protected function clearUserCache(int $userId): void
    {
        Cache::tags(['users'])->flush();
        Cache::forget(self::CACHE_PREFIX_FOR_ONE_USER . $userId);
    }
}
