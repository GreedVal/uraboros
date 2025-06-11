<?php

namespace App\Telegram\Actions\Request;

use Illuminate\Support\Facades\Log;

use App\Telegram\Factories\ChatDTOFactory;
use App\Telegram\Factories\MessageDTOFactory;
use App\Telegram\DTO\Request\SearchMessagesDTO;
use App\Telegram\Actions\AbstractTelegramAction;

class SearchMessagesAction extends AbstractTelegramAction
{
    public function execute(SearchMessagesDTO $dto): array
    {
        try {
            $response = $this->madeline()->messages->search($dto->toArray());

            return $this->processResponse($response);

        } catch (\Exception $e) {
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
