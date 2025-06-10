<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
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
        protected UserLogService $logService,
    )
    {
    }

    public function storeUser(array $userData): bool
    {
        $user = $this->userRepository->createUser($userData);

        if ($user) {

            $this->logService->log($user, CrudActionEnum::CREATE, $userData);

            return true;
        }

        return false;
    }

    public function updateUser(User $user, array $userData): bool
    {
        $oldData = $user->getOriginal();

        if (empty($userData['password'])) {
            unset($userData['password']);
        } else {
            $userData['password'] = Hash::make($userData['password']);
        }

        $updated = $this->userRepository->updateUser($user, $userData);

        if ($updated) {
            $this->logService->log($user, CrudActionEnum::UPDATE,
                [
                    'old' => $oldData,
                    'new' => $userData
                ]);
            
            return true;
        }

        return false;
    }
}
