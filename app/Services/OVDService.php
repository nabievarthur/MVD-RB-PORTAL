<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\OVD;
use App\Repositories\OVDRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Throwable;

class OVDService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OVDRepository $ovdRepository,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function storeOVD(array $ovdData): bool
    {
        try {
            $ovd = $this->ovdRepository->createOVD($ovdData);

            if (!$ovd) {
                return false;
            }

            $this->userLogService->log($ovd, CrudActionEnum::CREATE, $ovdData);
            return true;

        } catch (Throwable $e) {
            $this->exceptionLogService->logException(CrudActionEnum::CREATE, $e, ['ovdData' => $ovdData]);
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function updateOVD(OVD $ovd, array $ovdData): OVD
    {
        try {
            $oldData = $ovd->getOriginal();

            $updatedOvd = $this->ovdRepository->updateOVD($ovd->id, $ovdData);

            if (!$updatedOvd) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            $this->userLogService->log($updatedOvd, CrudActionEnum::UPDATE, [
                'old' => $oldData,
                'new' => $ovdData,
            ]);

            return $updatedOvd;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::UPDATE,
                $e,
                [
                    'ovd_id' => $ovd->id,
                    'data' => $ovdData,
                ]
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function deleteOVD(OVD $ovd): void
    {
        try {
            $oldData = $ovd->getOriginal();

            $this->ovdRepository->deleteOVD($ovd->id);

            $this->userLogService->log($ovd, CrudActionEnum::DELETE, [
                'old' => $oldData,
            ]);
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::DELETE,
                $e,
                [
                    'ovd_id' => $ovd->id,
                ]
            );
            throw $e;
        }
    }
}
