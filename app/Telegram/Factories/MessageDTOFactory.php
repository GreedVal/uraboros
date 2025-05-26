<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\MessageDTO;
use App\Telegram\DTO\Response\UserDTO;

class MessageDTOFactory
{
    public static function createFromArray(array $data, array $users = []): MessageDTO
    {
        $user = null;
        if (isset($data['from_id']) && isset($users[$data['from_id']])) {
            $userData = $users[$data['from_id']];
            $user = new UserDTO(
                $userData['id'],
                $userData['first_name'] ?? null,
                $userData['last_name'] ?? null,
                $userData['username'] ?? null
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
            $user
        );
    }
}
