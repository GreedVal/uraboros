<?php

namespace App\WebCheck\DTO\Response;

class DnsResultDTO
{
    public function __construct(
        public readonly string $type,
        public readonly string $host,
        public readonly ?string $ip = null,
        public readonly ?string $target = null,
        public readonly ?int $ttl = null,
        public readonly ?int $priority = null,
        public readonly array $raw = []
    ) {}
}
