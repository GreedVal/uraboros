<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\RobotsCheckResultDTO;
use App\WebCheck\Factories\RobotsCheckResultDTOFactory;

class CheckRobotsAction
{
    public function execute(CheckRequestDTO $dto): RobotsCheckResultDTO
    {
        $url = rtrim($dto->url, '/') . '/robots.txt';

        try {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                //Log::warning("Invalid robots.txt URL: {$url}");
                return RobotsCheckResultDTOFactory::create(false, 'Invalid URL');
            }

            $content = @file_get_contents($url);

            if ($content === false) {
                //Log::error("Failed to load robots.txt from: {$url}");
                return RobotsCheckResultDTOFactory::create(false, 'Failed to load robots.txt');
            }

            return RobotsCheckResultDTOFactory::create(true,$content);

        } catch (\Throwable $e) {
            //Log::error("Exception in CheckRobotsAction: " . $e->getMessage());
            return RobotsCheckResultDTOFactory::create(false, 'Exception: ' . $e->getMessage());
        }
    }
}
