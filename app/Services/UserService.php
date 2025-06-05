<?php

namespace App\Services;

use App\Models\User;
use Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(User $user)
    {

    }

    public function store(array $userData): bool
    {
        $user = User::create([
            'login' => $userData['login'],
            'password' => Hash::make($userData['password']),
            'full_name' => $userData['full_name'],
            'subdivision_id' => $userData['subdivision_id'],
        ]);

        if ($userData['role_id']) {
            $user->roles()->attach($userData['role_id']);
        }

        return $user ? true : false;
    }
}
