<?php

namespace App\WebCheck\DTO\Response;

class SslCertificateResultDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly ?array $subject,
        public readonly ?array $issuer,
        public readonly ?string $valid_from,
        public readonly ?string $valid_to,
        public readonly ?string $error
    ) {}
}
