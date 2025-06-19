<?php

namespace App\Services;

use App\Enums\CrudActionEnum;
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
            throw $e; // Пробрасываем исключение в контроллер
        }
    }
}
