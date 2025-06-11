<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Illuminate\Http\RedirectResponse;
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

    public function storeUser(array $userData): bool
    {
        try {
            $user = $this->userRepository->createUser($userData);

            if ($user) {

                $this->userLogService->log($user, CrudActionEnum::CREATE, $userData);

                return true;
            }

            return false;

        } catch (Throwable $e) {
            $this->exceptionLogService->logException(CrudActionEnum::CREATE, $e, ['userData' => $userData]);

            $message = $e->getMessage() ?: 'Неизвестная ошибка';

            session()->flash('error', 'Не удалось создать пользователя: ' . $message);

            return false;
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
