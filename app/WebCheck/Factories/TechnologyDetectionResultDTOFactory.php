<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\TechnologyResultDTO;
use App\WebCheck\DTO\Response\TechnologyDetectionResultDTO;

class TechnologyDetectionResultDTOFactory
{
    public static function createFromApiResponse(array $data): TechnologyDetectionResultDTO
    {
        $url = $data['url'] ?? '';
        $technologies = [];

        foreach ($data['technologies'] ?? [] as $tech) {
            $technologies[] = new TechnologyResultDTO(
                name: $tech['name'] ?? 'Unknown',
                version: $tech['version'] ?? null,
                category: $tech['categories'][0]['name'] ?? null
            );
        }

        return new TechnologyDetectionResultDTO($url, $technologies);
    }
}
