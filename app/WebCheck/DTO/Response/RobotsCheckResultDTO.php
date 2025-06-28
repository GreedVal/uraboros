<?php

namespace App\WebCheck\DTO\Response;

class RobotsCheckResultDTO
{
    public function __construct(
        public readonly bool $exists,
        public readonly string $content,
    ) {}
}
