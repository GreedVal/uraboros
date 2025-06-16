<?php

namespace App\WebCheck\Actions;

use App\WebCheck\DTO\Request\CheckRequestDTO;
use App\WebCheck\DTO\Response\RobotsCheckResultDTO;
use App\WebCheck\Factories\RobotsCheckResultDTOFactory;

class CheckRobotsAction
{
    public function execute(CheckRequestDTO $dto): RobotsCheckResultDTO
    {
        return RobotsCheckResultDTOFactory::createFromUrl($dto->url);
    }
}
