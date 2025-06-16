<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\IpResultDTO;


class CheckIpResultDTOFactory
{
    public static function create(string $host, string $ip): IpResultDTO
    {
        return new IpResultDTO(
            host: $host,
            ip: $ip,
            success: $ip !== $host
        );
    }
}
