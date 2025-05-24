<?php

namespace App\Telegram\Actions\Search;

use Illuminate\Support\Facades\Log;
use App\Telegram\DTO\Search\SearchMessagesDTO;
use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\Factories\MessageDTOFactory;

class SearchMessagesByWordAction extends AbstractTelegramAction
{
    public function execute(SearchMessagesDTO $dto): array
    {
        try {
            $response = $this->madeline()->messages->search([
                'peer' => $dto->chatUsername,
                'q' => $dto->query,
                'limit' => $dto->limit,
                'offset_id' => $dto->offsetId,
            ]);

            return $this->processResponse($response);

        } catch (\Exception $e) {
            Log::error("Error in SearchMessagesAction: " . $e->getMessage());
            return [];
        }
    }

    protected function processResponse(array $response): array
    {
        $messages = [];
        $usersMap = [];

        foreach ($response['users'] ?? [] as $user) {
            $usersMap[$user['id']] = $user;
        }

        $chatsMap = [];

        foreach ($response['chats'] ?? [] as $chat) {
            $chatsMap[$chat['id']] = $chat;
        }


        $messages['count'] = $response['count'];

        foreach ($response['messages'] ?? [] as $messageData) {
            if ($messageData['_'] !== 'message') {
                continue;
            }

            $messages['messages'][] = MessageDTOFactory::createFromArray($messageData, $usersMap, $chatsMap);
        }

        return $messages;
    }
}
