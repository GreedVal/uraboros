<?php

namespace App\WebCheck\DTO\Response;

class RedirectInfoResultDTO
{
    public function __construct(
        public readonly ?string $effectiveUrl,
        public readonly int $redirectCount
    ) {}
}
