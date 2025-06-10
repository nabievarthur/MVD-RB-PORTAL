<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function __construct(
        protected User $user
    )
    {
    }

    public function getPaginatedUsers():CursorPaginator
    {
        return $this->user
            ->with('role')
            ->orderBy('created_at', 'desc')
            ->cursorPaginate(10);
    }

    public function createUser(array $userData): User
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

        return $user;
    }

    public function updateUser(User $user, array $userData): bool
    {
        return $user->update($userData);
    }
}
