<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\TechnologyDetectionResultDTO;
use App\WebCheck\Factories\TechnologyDetectionResultDTOFactory;
use Illuminate\Support\Facades\Http;

class DetectTechnologiesAction
{
    public function execute(CheckRequestDTO $dto): ?TechnologyDetectionResultDTO
    {
        $apiKey = config('services.wappalyzer.api_key');

        $response = Http::withHeaders([
            'x-api-key' => $apiKey,
        ])->post('https://api.wappalyzer.com/v2/lookup/', [
            ['url' => $dto->url]
        ]);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json()[0] ?? [];

        return TechnologyDetectionResultDTOFactory::createFromApiResponse($data);
    }
}
