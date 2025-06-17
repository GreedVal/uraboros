<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\RedirectInfoResultDTO;

class RedirectInfoResultDTOFactory
{
    public static function createFromCurlInfo(array $info): RedirectInfoResultDTO
    {
        return new RedirectInfoResultDTO(
            effectiveUrl: $info['url'] ?? null,
            redirectCount: $info['redirect_count'] ?? 0,
            success: true,
            error: null
        );
    }

    public static function createError(string $error): RedirectInfoResultDTO
    {
        return new RedirectInfoResultDTO(
            effectiveUrl: null,
            redirectCount: 0,
            success: false,
            error: $error
        );
    }
}
