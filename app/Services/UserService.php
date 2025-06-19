<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Throwable;

class UserService
{
    public function __construct(
        protected User $user,
        protected UserRepository $userRepository,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
    ) {}

    /**
     * @throws Throwable
     */
    public function storeUser(array $userData): bool
    {
        try {
            $user = $this->userRepository->createUser($userData);

            if (!$user) {
                return false;
            }

            $this->userLogService->log($user, CrudActionEnum::CREATE, $userData);
            return true;
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

            // Удаляем пустой пароль, если он есть
            if (array_key_exists('password', $userData) && empty($userData['password'])) {
                unset($userData['password']);
            }

            $updatedUser = $this->userRepository->updateUser($user->id, $userData);

            if (!$updatedUser) {
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

            $this->userRepository->deleteUser($user->id);

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
}
