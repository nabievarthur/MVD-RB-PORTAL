<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
use App\Models\Subdivision;
use App\Repositories\SubdivisionRepository;
use App\Services\Log\ExceptionLogService;
use App\Services\Log\UserLogService;
use Throwable;

class SubdivisionService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected SubdivisionRepository $subdivisionRepository,
        protected UserLogService $userLogService,
        protected ExceptionLogService $exceptionLogService,
    )
    {
    }

    /**
     * @throws Throwable
     */
    public function storeSubdivision(array $subdivisionData): bool
    {
        try {
            $subdivision = $this->subdivisionRepository->createSubdivision($subdivisionData);

            if (!$subdivision) {
                return false;
            }

            $this->userLogService->log($subdivision, CrudActionEnum::CREATE, $subdivisionData);
            return true;

        } catch (Throwable $e) {
            $this->exceptionLogService->logException(CrudActionEnum::CREATE, $e, ['subdivisionData' => $subdivisionData]);
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function updateSubdivision(Subdivision $subdivision, array $subdivisionData): Subdivision
    {
        try {
            $oldData = $subdivision->getOriginal();

            $updatedOvd = $this->subdivisionRepository->updateSubdivision($subdivision->id, $subdivisionData);

            if (!$updatedOvd) {
                throw new \RuntimeException('Не удалось обновить пользователя.');
            }

            $this->userLogService->log($updatedOvd, CrudActionEnum::UPDATE, [
                'old' => $oldData,
                'new' => $subdivisionData,
            ]);

            return $updatedOvd;
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::UPDATE,
                $e,
                [
                    'subdivision_id' => $subdivision->id,
                    'data' => $subdivisionData,
                ]
            );
            throw $e;
        }
    }

    /**
     * @throws Throwable
     */
    public function deleteSubdivision(Subdivision $subdivision): void
    {
        try {
            $oldData = $subdivision->getOriginal();

            $this->subdivisionRepository->deleteSubdivision($subdivision->id);

            $this->userLogService->log($subdivision, CrudActionEnum::DELETE, [
                'old' => $oldData,
            ]);
        } catch (Throwable $e) {
            $this->exceptionLogService->logException(
                CrudActionEnum::DELETE,
                $e,
                [
                    'subdivision_id' => $subdivision->id,
                ]
            );
            throw $e;
        }
    }
}
