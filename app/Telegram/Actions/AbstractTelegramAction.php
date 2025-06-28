<?php

namespace App\Telegram\Actions;

use App\Facades\MadelineProto;
use Illuminate\Support\Facades\Log;

abstract class AbstractTelegramAction
{
    protected function madeline(): \danog\MadelineProto\API
    {
        return MadelineProto::getFacadeRoot();
    }

    protected function logError(string $context, \Throwable $e): void
    {
        Log::error("[$context] " . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
        ]);
    }
}
