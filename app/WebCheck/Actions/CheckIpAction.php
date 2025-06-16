<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Response\IpResultDTO;
use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\Factories\CheckIpResultDTOFactory;

class CheckIpAction
{
    public function execute(CheckRequestDTO $dto): IpResultDTO
    {
        $host = $dto->getHost();
        $ip = gethostbyname($host);

        return CheckIpResultDTOFactory::create($host, $ip);
    }
}
