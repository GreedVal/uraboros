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
        $headers = get_headers($dto->url, true) ?: [];
        return HttpHeaderResultDTOFactory::createFromArray($headers);
    }
}
