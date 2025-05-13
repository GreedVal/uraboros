<?php

namespace App\Telegram\Actions\Search;

use App\Facades\MadelineProto;
use Illuminate\Support\Facades\Log;
use App\Telegram\DTO\Search\SearchMessagesDTO;
use App\Telegram\Actions\AbstractTelegramAction;

class SearchMessagesByWordAction extends AbstractTelegramAction
{
    public function execute(SearchMessagesDTO $dto): ?array
    {
        try {

            return $this->madeline()->messages->search([
                'peer' => $dto->chatUsername,
                'q' => $dto->query,
                'limit' => $dto->limit,
                'offset_id' => $dto->offsetId,
            ]);

        } catch (\Exception $e) {
            Log::error("Error in SearchMessagesAction: " . $e->getMessage());
            return null;
        }
    }
}
