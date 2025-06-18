<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\RobotsCheckResultDTO;

class RobotsCheckResultDTOFactory
{
    public static function create(bool $url, string $content): RobotsCheckResultDTO
    {
        return new RobotsCheckResultDTO(
            exists: $url !== false,
            content: $content ?: '',
        );
    }
}
