<?php

namespace App\Telegram\Actions\Request;

use App\Telegram\Actions\AbstractTelegramAction;
use Illuminate\Support\Facades\Log;
use App\Telegram\DTO\Request\ParticipantsRequestDTO;

class GetGroupParticipantsAction extends AbstractTelegramAction
{
    public function execute(ParticipantsRequestDTO $dto): ?array
    {
        try {
            return $this->madeline()->channels->getParticipants($dto->toArray());

        } catch (\Exception $e) {
            Log::error("Error in GetGroupParticipantsAction: " . $e->getMessage());
            return null;
        }
    }
}
