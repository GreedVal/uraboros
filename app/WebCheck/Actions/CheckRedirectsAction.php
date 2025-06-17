<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\RedirectInfoResultDTO;
use App\WebCheck\Factories\RedirectInfoResultDTOFactory;

class CheckRedirectsAction
{
    public function execute(CheckRequestDTO $dto): RedirectInfoResultDTO
    {
        $url = $dto->url;

        try {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                //Log::warning("Invalid URL in CheckRedirectsAction: {$url}");
                return RedirectInfoResultDTOFactory::createError("Invalid URL");
            }

            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => true,
                CURLOPT_NOBODY => true,
                CURLOPT_TIMEOUT => 10,
            ]);

            curl_exec($ch);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                //Log::error("cURL error in CheckRedirectsAction: {$error}");
                curl_close($ch);
                return RedirectInfoResultDTOFactory::createError($error);
            }

            $info = curl_getinfo($ch);
            curl_close($ch);

            return RedirectInfoResultDTOFactory::createFromCurlInfo($info);

        } catch (\Throwable $e) {
            //Log::error("Exception in CheckRedirectsAction: " . $e->getMessage());
            return RedirectInfoResultDTOFactory::createError("Exception: " . $e->getMessage());
        }
    }
}
