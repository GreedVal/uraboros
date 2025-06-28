<?php

namespace App\WebCheck\Services;

use App\WebCheck\Actions\CheckIpAction;
use App\WebCheck\Actions\CheckDnsAction;
use App\WebCheck\Actions\CheckSslAction;
use App\WebCheck\DTO\Response\IpResultDTO;
use App\WebCheck\Actions\CheckRobotsAction;
use App\WebCheck\Actions\CheckHeadersAction;
use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\Actions\CheckRedirectsAction;
use App\WebCheck\Actions\DetectTechnologiesAction;
use App\WebCheck\DTO\Response\RobotsCheckResultDTO;
use App\WebCheck\DTO\Response\RedirectInfoResultDTO;
use App\WebCheck\DTO\Response\SslCertificateResultDTO;
use App\WebCheck\DTO\Response\TechnologyDetectionResultDTO;

class WebCheckService
{
    public function __construct(
        protected CheckIpAction $checkIp,
        protected CheckDnsAction $checkDns,
        protected CheckSslAction $checkSsl,
        protected CheckHeadersAction $checkHeaders,
        protected CheckRedirectsAction $checkRedirects,
        protected CheckRobotsAction $checkRobots,
        protected DetectTechnologiesAction $detectTechnologies,
    ) {}

    public function checkAll(CheckRequestDTO $dto): array
    {
        return [
            'ip' => $this->checkIp->execute($dto),
            'dns' => $this->checkDns->execute($dto),
            'ssl' => $this->checkSsl->execute($dto),
            'headers' => $this->checkHeaders->execute($dto),
            'redirects' => $this->checkRedirects->execute($dto),
            'robots' => $this->checkRobots->execute($dto),
            'technologies' => $this->detectTechnologies->execute($dto),
        ];
    }

    public function checkIp(CheckRequestDTO $dto): ?IpResultDTO
    {
        return $this->checkIp->execute($dto);
    }

    public function checkDns(CheckRequestDTO $dto): ?array
    {
        return $this->checkDns->execute($dto);
    }

    public function checkSsl(CheckRequestDTO $dto): ?SslCertificateResultDTO
    {
        return $this->checkSsl->execute($dto);
    }

    public function checkHeaders(CheckRequestDTO $dto): ?array
    {
        return $this->checkHeaders->execute($dto);
    }

    public function checkRedirects(CheckRequestDTO $dto): ?RedirectInfoResultDTO
    {
        return $this->checkRedirects->execute($dto);
    }

    public function checkRobots(CheckRequestDTO $dto): ?RobotsCheckResultDTO
    {
        return $this->checkRobots->execute($dto);
    }

    public function detectTechnologies(CheckRequestDTO $dto): ?TechnologyDetectionResultDTO
    {
        return $this->detectTechnologies->execute($dto);
    }
}
