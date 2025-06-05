<?php

namespace App\Telegram\Actions\Request;

use Illuminate\Support\Facades\Log;
use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\DTO\Request\GetFullInfoRequestDTO;
use App\Telegram\Factories\FullInfoChatDTOFactory;

class GetFullInfoAction extends AbstractTelegramAction
{
    public function execute(GetFullInfoRequestDTO $dto): ?array
    {
        try {
            $response = $this->madeline()->getFullInfo($dto->name);
            $result[] = FullInfoChatDTOFactory::createFromArray($response);
            return $result;

        } catch (\Exception $e) {
            Log::error("Error in GetFullInfoAction: " . $e->getMessage());
            return null;
        }
    }
}
