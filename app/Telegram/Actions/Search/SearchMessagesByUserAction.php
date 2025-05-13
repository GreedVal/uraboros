<?php

namespace App\Telegram\Actions\Search;

use App\Facades\MadelineProto;
use Illuminate\Support\Facades\Log;
use App\Telegram\DTO\Search\SearchMessagesDTO;
use App\Telegram\Actions\AbstractTelegramAction;

class SearchMessagesByUserAction extends AbstractTelegramAction
{
    public function execute(SearchMessagesDTO $dto): ?array
    {
        try {

            return $this->madeline()->messages->search([
                'peer' => $dto->chatUsername,
                'from_id' => $dto->fromId,
                'limit' => $dto->limit,
                'offset_id' => $dto->offsetId,
            ]);

        } catch (\Throwable $e) {
            $this->logError('SearchMessagesByUserAction', $e);
            return null;
        }
    }
}
