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
        protected FileService $fileService,
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

            if ($request->has('file') && $request->file) {
                $this->fileService->uploadFile(
                    $request->file,
                    $leader,
                    'leader_files'
                );
            }

            return $leader;

        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::CREATE,
                $e,
                ['data' => $data ?? []]
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

            $file = $leaderData['file'] ?? null;
            unset($leaderData['file']);

            $updatedLeader = $this->leaderRepository->updateLeader($leader->id, $leaderData);
            if (! $updatedLeader) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            if ($file) {
                // Удаляем старые файлы
                $this->fileService->deleteModelFiles($leader);

                // Загружаем новый файл
                $this->fileService->uploadFile($file, $leader, 'leader_files');
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
    public function deleteLeader(Leader $leader): void
    {
        try {
            $oldData = $leader->getOriginal();

            // Удаляем все файлы модели
            $this->fileService->deleteModelFiles($leader);

            $success = $this->leaderRepository->deleteLeader($leader->id);
            if (! $success) {
                throw new \RuntimeException('Не удалось удалить пользователя.');
            }

            $this->userLogService->log($leader, CrudActionEnum::DELETE, [
                'old' => $oldData,
            ]);
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::DELETE,
                $e,
                [
                    'user_id' => $leader->id,
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
