<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\User;
use App\Repositories\UserRepository;

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

    public function updateUser(User $user, array $userData): User|false
    {
        $oldData = $user->getOriginal();

        if (empty($userData['password'])) {
            unset($userData['password']);
        }

        $updatedUser = $this->userRepository->updateUser($user->id, $userData);

        if (!$updatedUser) {
            return false;
        }

        $this->logService->log($updatedUser, CrudActionEnum::UPDATE, [
            'old' => $oldData,
            'new' => $userData,
        ]);

        return $updatedUser;
    }
}
