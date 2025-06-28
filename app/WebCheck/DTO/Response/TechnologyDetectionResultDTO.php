<?php

namespace App\WebCheck\DTO\Response;

class TechnologyDetectionResultDTO
{
    /**
     * @param TechnologyResultDTO[] $technologies
     */
    public function __construct(
        public readonly string $url,
        public readonly array $technologies
    ) {}
}
