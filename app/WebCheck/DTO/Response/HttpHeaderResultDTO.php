<?php

namespace App\WebCheck\DTO\Response;

class HttpHeaderResultDTO
{
    public function __construct(
        public readonly string $name,
        public readonly array $values
    ) {}
}
