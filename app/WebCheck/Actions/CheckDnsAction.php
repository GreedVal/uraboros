<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Response\DnsResultDTO;
use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\Factories\DnsResultDTOFactory;


class CheckDnsAction
{
    /**
     * @return DnsResultDTO[]
     */
    public function execute(CheckRequestDTO $dto): array
    {
        try {
            $host = $dto->getHost();

            if (!filter_var(gethostbyname($host), FILTER_VALIDATE_IP)) {
                //Log::warning("Invalid host: {$host}");
                return [];
            }

            $records = dns_get_record($host, DNS_ALL);

            if ($records === false) {
                //Log::error("Failed to get DNS records for host: {$host}");
                return [];
            }

            return DnsResultDTOFactory::createCollection($records);

        } catch (\Throwable $e) {
            //Log::error("DNS check failed: " . $e->getMessage());
            return [];
        }
    }
}
