<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected User           $user,
        protected UserRepository $userRepository,
    )
    {
    }

    public function storeUser(array $userData): bool
    {
        $user = $this->userRepository->createUser($userData);

        return $user ? true : false;
    }

    public function updateUser(User $user, array $userData): bool
    {
        if (empty($userData['password'])) {
            unset($userData['password']);
        } else {
            $userData['password'] = Hash::make($userData['password']);
        }

        return $this->userRepository->updateUser($user, $userData);
    }
}
