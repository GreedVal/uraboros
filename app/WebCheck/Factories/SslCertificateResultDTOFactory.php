<?php

namespace App\WebCheck\Factories;

use App\WebCheck\DTO\Response\SslCertificateResultDTO;

class SslCertificateResultDTOFactory
{
    public static function createFromHost(string $host, int $port = 443): SslCertificateResultDTO
    {
        $context = stream_context_create(["ssl" => ["capture_peer_cert" => true]]);
        $client = @stream_socket_client("ssl://{$host}:{$port}", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context);

        if (!$client) {
            return new SslCertificateResultDTO(
                success: false,
                error: $errstr
            );
        }

        $params = stream_context_get_params($client);
        $cert = openssl_x509_parse($params["options"]["ssl"]["peer_certificate"]);

        return new SslCertificateResultDTO(
            success: true,
            subject: $cert['subject'] ?? null,
            issuer: $cert['issuer'] ?? null,
            validFrom: isset($cert['validFrom_time_t']) ? date('Y-m-d H:i:s', $cert['validFrom_time_t']) : null,
            validTo: isset($cert['validTo_time_t']) ? date('Y-m-d H:i:s', $cert['validTo_time_t']) : null
        );
    }
}
