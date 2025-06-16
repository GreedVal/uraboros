<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\RobotsCheckResultDTO;

class RobotsCheckResultDTOFactory
{
    public static function createFromUrl(string $url): RobotsCheckResultDTO
    {
        $robotsUrl = rtrim($url, '/') . '/robots.txt';
        $content = @file_get_contents($robotsUrl);

        return new RobotsCheckResultDTO(
            exists: $content !== false,
            content: $content ?: ''
        );
    }
}
