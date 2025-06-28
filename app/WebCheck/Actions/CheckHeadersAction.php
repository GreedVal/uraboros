<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\HttpHeaderResultDTO;
use App\WebCheck\Factories\HttpHeaderResultDTOFactory;

class CheckHeadersAction
{
    /**
     * @return HttpHeaderResultDTO[]
     */
    public function execute(CheckRequestDTO $dto): array
    {
        try {
            $url = $dto->url;

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                //Log::warning("Invalid URL in CheckHeadersAction: {$url}");
                return [];
            }

            $headers = @get_headers($url, true);

            if ($headers === false || !is_array($headers)) {
                //Log::error("Failed to retrieve headers from URL: {$url}");
                return [];
            }

            return HttpHeaderResultDTOFactory::createFromArray($headers);

        } catch (\Throwable $e) {
            //Log::error("CheckHeadersAction error: " . $e->getMessage());
            return [];
        }
    }
}
