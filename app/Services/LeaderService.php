<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Http\Requests\Admin\Leader\LeaderStoreRequest;
use App\Models\Leader;
use App\Repositories\LeaderRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

            // Проверяем, является ли file base64 строкой
            if ($request->has('file') && is_string($request->file) && strpos($request->file, 'data:image') === 0) {
                $this->handleBase64Image($request->file, $leader);
            }
            // Или обычным файлом
            elseif ($request->hasFile('file')) {
                $this->fileUploadService->uploadFiles('leader_files', $leader, $request->file('file'));
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

    protected function handleBase64Image(string $base64Image, Leader $leader): void
    {
        // Проверяем формат: data:image/{ext};base64,{data}
        if (! preg_match('/^data:image\/(jpeg|jpg|png|gif);base64,(.+)$/', $base64Image, $matches)) {
            return;
        }

        $extension = strtolower($matches[1]);
        $data = $matches[2];

        // Нормализуем jpeg → jpg
        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }

        // Декодируем base64
        $decodedData = base64_decode($data, true);
        if ($decodedData === false) {
            return;
        }

        // Генерируем уникальное имя
        $filename = 'leader_files/'.uniqid('', true).'.'.$extension;

        // Сохраняем файл
        Storage::disk('public')->put($filename, $decodedData);

        $leader->files()->create([
            'path' => $filename,
            'original_name' => 'leader'.$extension,
            'mime_type' => 'image/'.$extension,
            'size' => strlen($decodedData),
        ]);

        Cache::tags(['leaders'])->flush();
    }

    /**
     * @throws Throwable
     */
    public function updateLeader(Leader $leader, array $leaderData): Leader
    {
        try {
            $oldData = $leader->getOriginal();

            $leaderData = $this->handlePassword($leaderData);

            // Извлекаем файл из данных, если он есть
            $file = $leaderData['file'] ?? null;
            unset($leaderData['file']); // Убираем, чтобы не мешало апдейту

            $updatedLeader = $this->leaderRepository->updateLeader($leader->id, $leaderData);
            if (! $updatedLeader) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            // --- Работаем с файлами ---
            if ($file) {
                // Удаляем старые файлы (если политика такая)
                foreach ($leader->files as $existingFile) {
                    $this->fileUploadService->destroyFile($existingFile);
                }

                // Если file = base64 строка
                if (is_string($file) && strpos($file, 'data:image') === 0) {
                    $this->handleBase64Image($file, $leader);
                }
                // Если file = UploadedFile
                elseif ($file instanceof UploadedFile) {
                    $this->fileUploadService->uploadFiles('leader_files', $leader, $file);
                }
            }

            // Логируем изменения
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

            foreach ($leader->files as $file) {
                $file->delete();
            }

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
