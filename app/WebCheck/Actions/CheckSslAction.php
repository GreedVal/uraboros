<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\SslCertificateResultDTO;
use App\WebCheck\Factories\SslCertificateResultDTOFactory;
use Illuminate\Support\Facades\Log;

class CheckSslAction
{
    public function execute(CheckRequestDTO $dto): SslCertificateResultDTO
    {
        $host = $dto->getHost();
        $port = 443;

        if (!filter_var("https://{$host}", FILTER_VALIDATE_URL)) {
            Log::warning("Invalid host in CheckSslAction: {$host}");
            return SslCertificateResultDTOFactory::createError("Invalid host");
        }

        try {
            $context = stream_context_create([
                "ssl" => ["capture_peer_cert" => true]
            ]);

            $client = @stream_socket_client(
                "ssl://{$host}:{$port}",
                $errno,
                $errstr,
                10,
                STREAM_CLIENT_CONNECT,
                $context
            );

            if (!$client) {
                Log::error("SSL connection failed for {$host}: {$errstr}");
                return SslCertificateResultDTOFactory::createError($errstr);
            }

            $params = stream_context_get_params($client);
            $cert = openssl_x509_parse($params["options"]["ssl"]["peer_certificate"]);

            return SslCertificateResultDTOFactory::createFromParsedCertificate($cert);

        } catch (\Throwable $e) {
            Log::error("Exception in CheckSslAction: " . $e->getMessage());
            return SslCertificateResultDTOFactory::createError("Exception: " . $e->getMessage());
        }
    }
}
