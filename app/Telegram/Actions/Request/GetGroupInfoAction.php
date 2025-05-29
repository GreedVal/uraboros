<?php

namespace App\Telegram\Actions\Request;

use Illuminate\Support\Facades\Log;
use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\DTO\Request\GroupInfoRequestDTO;

class GetGroupInfoAction extends AbstractTelegramAction
{
    public function execute(GroupInfoRequestDTO $dto): ?array
    {
        try {
            return $this->madeline()->getInfo($dto->chatUsername);

        } catch (\Exception $e) {
            Log::error("Error in GetGroupInfoAction: " . $e->getMessage());
            return null;
        }
    }
}
