<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\SslCertificateResultDTO;

class SslCertificateResultDTOFactory
{
public static function createError(string $error): SslCertificateResultDTO
{
    return new SslCertificateResultDTO(
        success: false,
        subject: null,
        issuer: null,
        valid_from: null,
        valid_to: null,
        error: $error
    );
}

public static function createFromParsedCertificate(array $cert): SslCertificateResultDTO
{
    return new SslCertificateResultDTO(
        success: true,
        subject: $cert['subject'] ?? null,
        issuer: $cert['issuer'] ?? null,
        valid_from: isset($cert['validFrom_time_t']) ? date('Y-m-d H:i:s', $cert['validFrom_time_t']) : null,
        valid_to: isset($cert['validTo_time_t']) ? date('Y-m-d H:i:s', $cert['validTo_time_t']) : null,
        error: null
    );
}
}
