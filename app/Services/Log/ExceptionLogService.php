<?php

namespace App\Services\Log;

use App\Enums\CrudActionEnum;
use App\Models\ExceptionLog;
use Throwable;

class ExceptionLogService
{
    public function __construct()
    {
    }


    public function logException(CrudActionEnum $action, Throwable $e, array $context = []): void
    {
        $caller = $this->getCallerClass();

        ExceptionLog::create([
            'service' => $caller,
            'method' => $action,
            'message' => $e->getMessage(),
            'context' => json_encode($context),
        ]);

    }

    private function getCallerClass(): ?string
    {
        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10) as $trace) {
            if (isset($trace['class']) && $trace['class'] !== self::class) {
                return $trace['class'];
            }
        }

        return null;
    }
}
