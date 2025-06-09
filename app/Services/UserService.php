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

    public function storeUser(array $userData): bool
    {
        $user = User::create([
            'login' => $userData['login'],
            'password' => Hash::make($userData['password']),
            'last_name' => $userData['last_name'],
            'first_name' => $userData['first_name'],
            'surname' => $userData['surname'],
            'subdivision_id' => $userData['subdivision_id'],
        ]);

        if ($userData['role_id']) {
            $user->roles()->attach($userData['role_id']);
        }

        return $user ? true : false;
    }
}
