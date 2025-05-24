<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\MessageDTO;
use App\Telegram\DTO\Response\UserDTO;
use App\Telegram\DTO\Response\ChatDTO;

class MessageDTOFactory
{
    public static function createFromArray(array $data, array $users = [], array $chats = []): MessageDTO
    {
        $user = null;
        if (isset($data['from_id']) && isset($users[$data['from_id']])) {
            $userData = $users[$data['from_id']];
            $user = new UserDTO(
                $userData['id'],
                $userData['first_name'],
                $userData['last_name'] ?? null,
                $userData['username'] ?? null
            );
        }

        $chat = null;
        if (isset($chats[$data['peer_id']])) {
            $chatData = $chats[$data['peer_id']];
            $chat = new ChatDTO(
                $chatData['id'],
                $chatData['title'],
                $chatData['username'] ?? null,
                $chatData['megagroup'] ?? false
            );
        }

        return new MessageDTO(
            $data['id'],
            $data['from_id'] ?? 0,
            $data['peer_id'],
            $data['reply_to']['reply_to_msg_id'] ?? null,
            $data['date'],
            $data['message'],
            $data['out'] ?? false,
            $user,
            $chat
        );
    }
}
