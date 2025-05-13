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
            return $this->madeline()->messages->search([
                'channel' => $dto->chatUsername,
                'filter' => ['_' => 'channelParticipantsRecent'],
                'offset' => $dto->offset,
                'limit' => $dto->limit,
            ]);

        } catch (\Exception $e) {
            Log::error("Error in GetGroupParticipantsAction: " . $e->getMessage());
            return null;
        }
    }
}
