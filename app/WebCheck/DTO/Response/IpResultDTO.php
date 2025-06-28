<?php

namespace App\WebCheck\DTO\Response;

class IpResultDTO
{
    public function __construct(
        public readonly string $host,
        public readonly string $ip,
        public readonly bool $success
    ) {}
}
