<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\DnsResultDTO;

class DnsResultDTOFactory
{
    public static function createFromArray(array $record): DnsResultDTO
    {
        return new DnsResultDTO(
            type: $record['type'] ?? 'UNKNOWN',
            host: $record['host'] ?? '',
            ip: $record['ip'] ?? null,
            target: $record['target'] ?? null,
            ttl: $record['ttl'] ?? null,
            priority: $record['pri'] ?? null,
            raw: $record
        );
    }

    public static function createCollection(array $records): array
    {
        return array_map([self::class, 'createFromArray'], $records);
    }
}
