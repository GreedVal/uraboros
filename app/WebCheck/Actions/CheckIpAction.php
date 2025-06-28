<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\IpResultDTO;
use App\WebCheck\Factories\CheckIpResultDTOFactory;
use Illuminate\Support\Facades\Log;

class CheckIpAction
{
    public function execute(CheckRequestDTO $dto): IpResultDTO
    {
        try {
            $host = $dto->getHost();
            $ip = gethostbyname($host);

            if ($ip === $host || !filter_var($ip, FILTER_VALIDATE_IP)) {
                //Log::warning("Invalid or unresolved host: {$host}, resolved IP: {$ip}");
                return CheckIpResultDTOFactory::create($host, 0);
            }

            return CheckIpResultDTOFactory::create($host, $ip, true);

        } catch (\Throwable $e) {
            //Log::error("CheckIpAction error: " . $e->getMessage());
            return CheckIpResultDTOFactory::create($dto->getHost(), 0);
        }
    }
}
