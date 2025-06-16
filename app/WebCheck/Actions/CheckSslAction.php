<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\SslCertificateResultDTO;
use App\WebCheck\Factories\SslCertificateResultDTOFactory;

class CheckSslAction
{
    public function execute(CheckRequestDTO $dto): SslCertificateResultDTO
    {
        return SslCertificateResultDTOFactory::createFromHost($dto->getHost());
    }
}
