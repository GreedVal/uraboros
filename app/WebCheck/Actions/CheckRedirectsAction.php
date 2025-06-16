<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\RedirectInfoResultDTO;
use App\WebCheck\Factories\RedirectInfoResultDTOFactory;


class CheckRedirectsAction
{
    public function execute(CheckRequestDTO $dto): RedirectInfoResultDTO
    {
        $ch = curl_init($dto->url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
        ]);
        curl_exec($ch);

        $info = curl_getinfo($ch);
        curl_close($ch);

        return RedirectInfoResultDTOFactory::createFromCurlInfo($info);
    }
}
