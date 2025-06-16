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
        $records = dns_get_record($dto->getHost(), DNS_ALL) ?: [];
        return DnsResultDTOFactory::createCollection($records);
    }
}
