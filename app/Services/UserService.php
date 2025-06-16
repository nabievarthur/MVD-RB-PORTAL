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
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected User                $user,
        protected UserRepository      $userRepository,
        protected UserLogService      $userLogService,
        protected ExceptionLogService $exceptionLogService,
    )
    {
    }

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
            $this->exceptionLogService->logException(CrudActionEnum::CREATE, $e, ['userData' => $userData]);
            throw $e; // Пробрасываем исключение в контроллер
        }
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

        $this->userLogService->log($updatedUser, CrudActionEnum::UPDATE, [
            'old' => $oldData,
            'new' => $userData,
        ]);

        return $updatedUser;
    }
}
