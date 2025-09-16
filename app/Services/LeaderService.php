<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Http\Requests\Admin\Leader\LeaderStoreRequest;
use App\Models\Leader;
use App\Repositories\LeaderRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Illuminate\Support\Facades\Hash;
use Throwable;

class LeaderService
{
    public function __construct(
        protected LeaderRepository $leaderRepository,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
        protected FileService $fileUploadService,
    ) {}

    /**
     * @throws Throwable
     */
    public function storeLeader(LeaderStoreRequest $request): Leader
    {
        try {
            $data = $request->except(['_token', 'file']);

            $leader = $this->leaderRepository->createLeader($data);

            $this->userLogService->log($leader, CrudActionEnum::CREATE, $data);

            if ($request->hasFile('file')) {
                $this->fileUploadService->uploadFiles('leader_files', $leader, $request->file('file'));
            }

            return $leader;

        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::CREATE,
                $e,
                ['data' => $data ?? []] // Добавлено ?? [] на случай если $data не определена
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function updateLeader(Leader $leader, array $leaderData): Leader
    {
        try {
            $oldData = $leader->getOriginal();

            $leaderData = $this->handlePassword($leaderData);

            $updatedLeader = $this->leaderRepository->updateLeader($leader->id, $leaderData);
            if (! $updatedLeader) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            $this->userLogService->log($updatedLeader, CrudActionEnum::UPDATE, [
                'old' => $oldData,
                'new' => $leaderData,
            ]);

            return $updatedLeader;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::UPDATE,
                $e,
                [
                    'leader_id' => $leader->id,
                    'data' => $leaderData,
                ]
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function deleteLeader(Leader $user): void
    {
        try {
            $oldData = $user->getOriginal();

            $success = $this->leaderRepository->deleteLeader($user->id);
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
