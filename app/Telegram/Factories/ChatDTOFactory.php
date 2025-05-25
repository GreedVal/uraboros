<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\ChatDTO;

class ChatDTOFactory
{
    public static function createFromArray(array $data): ChatDTO
    {
        return new ChatDTO(
                $data['id'],
                $data['title'],
                $data['username'] ?? null,
                $data['megagroup'] ?? false
            );
    }
}
