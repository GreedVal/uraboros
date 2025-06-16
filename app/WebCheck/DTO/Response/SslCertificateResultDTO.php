<?php

namespace App\WebCheck\DTO\Response;

class SslCertificateResultDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly ?array $subject = null,
        public readonly ?array $issuer = null,
        public readonly ?string $validFrom = null,
        public readonly ?string $validTo = null,
        public readonly ?string $error = null
    ) {}
}
