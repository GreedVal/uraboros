<?php

namespace App\Telegram\Actions\Search;

use Illuminate\Support\Facades\Log;
use App\Telegram\DTO\Search\SearchMessagesDTO;
use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\Factories\ChatDTOFactory;
use App\Telegram\Factories\MessageDTOFactory;

class SearchMessagesAction extends AbstractTelegramAction
{
    public function execute(SearchMessagesDTO $dto): array
    {
        try {
            $response = $this->madeline()->messages->search([
                'peer' => $dto->chatUsername,
                'q' => $dto->query,
                'from_id' => $dto->fromId,
                'filter' => $dto->filter,
                'min_date' => $dto->minDate,
                'max_date' => $dto->maxDate,
                'offset_id' => $dto->offsetId,
                'add_offset' => $dto->addOffset,
                'limit' => $dto->limit,
                'max_id' => $dto->maxId,
                'min_id' => $dto->minId,
                'hash' => $dto->hash,
            ]);

            return $this->processResponse($response);

        } catch (\Exception $e) {
            //Log::error("Error in SearchMessagesAction: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    protected function processResponse(array $response): array
    {
        $messages = [];
        $usersMap = [];

        foreach ($response['users'] ?? [] as $user) {
            $usersMap[$user['id']] = $user;
        }

        $messages['count'] = $response['count'];

        foreach ($response['chats'] ?? [] as $chat) {
            $messages['chat'][] = ChatDTOFactory::createFromArray($chat);
        }

        foreach ($response['messages'] ?? [] as $messageData) {
            if ($messageData['_'] !== 'message') {
                continue;
            }

            $messages['messages'][] = MessageDTOFactory::createFromArray($messageData, $usersMap);
        }

        return $messages;
    }
}
