<?php

namespace App\Telegram\Actions\Request;

use Illuminate\Support\Facades\Log;
use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\DTO\Request\GetGroupInfoRequestDTO;

class GetGroupInfoAction extends AbstractTelegramAction
{
    public function execute(GetGroupInfoRequestDTO $dto): ?array
    {
        try {
            return $this->madeline()->getInfo($dto->chatUsername);

        } catch (\Exception $e) {
            Log::error("Error in GetGroupInfoAction: " . $e->getMessage());
            return null;
        }
    }
}
