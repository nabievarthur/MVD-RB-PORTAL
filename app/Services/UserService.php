<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
    ) {}

    /**
     * @throws Throwable
     */
    public function storeUser(array $userData): User
    {
        try {
            $userData = $this->handlePassword($userData);

            $user = $this->userRepository->createUser($userData);
            if (! $user) {
                throw new \RuntimeException('Не удалось создать пользователя');
            }

            $this->userLogService->log($user, CrudActionEnum::CREATE, $userData);

            return $user;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::CREATE,
                $e,
                ['userData' => $userData]
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function updateUser(User $user, array $userData): User
    {
        try {
            $oldData = $user->getOriginal();

            $userData = $this->handlePassword($userData);

            $updatedUser = $this->userRepository->updateUser($user->id, $userData);
            if (! $updatedUser) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            $this->userLogService->log($updatedUser, CrudActionEnum::UPDATE, [
                'old' => $oldData,
                'new' => $userData,
            ]);

            return $updatedUser;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::UPDATE,
                $e,
                [
                    'user_id' => $user->id,
                    'data' => $userData,
                ]
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function deleteUser(User $user): void
    {
        try {
            $oldData = $user->getOriginal();

            $success = $this->userRepository->deleteUser($user->id);
            if (! $success) {
                throw new \RuntimeException('Не удалось удалить пользователя.');
            }

            $this->userLogService->log($user, CrudActionEnum::DELETE, [
                'old' => $oldData,
            ]);
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::DELETE,
                $e,
                [
                    'user_id' => $user->id,
                ]
            );
            throw $e;
        }
    }

    private function handlePassword(array $userData): array
    {
        if (array_key_exists('password', $userData)) {
            if (empty($userData['password'])) {
                unset($userData['password']);
            } else {
                $userData['password'] = Hash::make($userData['password']);
            }
        }

        return $userData;
    }
}
