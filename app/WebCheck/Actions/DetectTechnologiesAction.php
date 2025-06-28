<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\TechnologyDetectionResultDTO;
use App\WebCheck\Factories\TechnologyDetectionResultDTOFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DetectTechnologiesAction
{
    public function execute(CheckRequestDTO $dto): ?TechnologyDetectionResultDTO
    {
        $url = $dto->url;
        $apiKey = config('services.wappalyzer.api_key');

        if (empty($apiKey)) {
            Log::error('Wappalyzer API key is missing.');
            return null;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            Log::warning("Invalid URL for technology detection: {$url}");
            return null;
        }

        try {
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
            ])->post('https://api.wappalyzer.com/v2/lookup/', [
                ['url' => $url]
            ]);

            if ($response->failed()) {
                Log::error("Wappalyzer API request failed: {$response->status()} - {$response->body()}");
                return null;
            }

            $data = $response->json()[0] ?? [];

            return TechnologyDetectionResultDTOFactory::createFromApiResponse($data);

        } catch (\Throwable $e) {
            Log::error("Exception in DetectTechnologiesAction: " . $e->getMessage());
            return null;
        }
    }
}
