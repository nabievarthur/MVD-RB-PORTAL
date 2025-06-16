<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Cache;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    const CACHE_PREFIX_FOR_ALL_USERS = 'users:all';
    const CACHE_PREFIX_FOR_ONE_USER = 'users:';
    const CACHE_TTL = 60 * 24;

    public function __construct(
        protected User $user
    )
    {
    }

    public function findUserById(int $userId): ?User
    {
        return Cache::remember(self::CACHE_PREFIX_FOR_ONE_USER . $userId, self::CACHE_TTL, function () use ($userId) {
            return $this->user->find($userId);
        });

    }

    public function getPaginatedUsers(): CursorPaginator
    {
        return Cache::tags(['users'])->remember(self::CACHE_PREFIX_FOR_ALL_USERS, self::CACHE_TTL, function () {
            return $this->user
                ->with('role')
                ->orderBy('created_at', 'desc')
                ->cursorPaginate(10);
        });

    }

    public function createUser(array $userData): ?User
    {
        $user = $this->user->create([
            'login' => $userData['login'],
            'password' => Hash::make($userData['password']),
            'last_name' => $userData['last_name'],
            'first_name' => $userData['first_name'],
            'surname' => $userData['surname'],
            'subdivision_id' => $userData['subdivision_id'],
            'role_id' => $userData['role_id'],
        ]);

        Cache::tags(['users'])->flush();

        return $user;
    }

    public function updateUser(int $userId, array $userData): ?User
    {
        $user = $this->findUserById($userId);

        if (!$user) {
            return null;
        }

        $result = $user->update($userData);

        if ($result) {
            Cache::tags(['users'])->flush();
            Cache::forget(self::CACHE_PREFIX_FOR_ONE_USER . $user->id);
        }

        return $user;
    }

    public function deleteUser(int $userId): bool
    {
        $deletedUser = $this->findUserById($userId);

        if (!$deletedUser) {
            return false;
        }

        $result = $deletedUser->delete();

        if ($result) {
            Cache::tags(['users'])->flush();
            Cache::forget(self::CACHE_PREFIX_FOR_ALL_USERS . $userId);
        }

        return true;
    }
}
