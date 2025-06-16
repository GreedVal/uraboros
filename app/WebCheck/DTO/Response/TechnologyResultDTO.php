<?php

namespace App\WebCheck\DTO\Response;

class TechnologyResultDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $version,
        public readonly ?string $category
    ) {}
}
