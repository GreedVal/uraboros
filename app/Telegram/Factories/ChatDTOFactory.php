<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\Messages\ChatDTO;

class ChatDTOFactory
{
    public static function createFromArray(array $data): ChatDTO
    {
        return new ChatDTO(
            id: $data['id'],
            title: $data['title'],
            username: $data['username'] ?? null,
            type: match($data['_']) {
                'channel' => 'channel',
                'chat' => 'chat',
                default => 'group'
            },
            isMegagroup: $data['megagroup'] ?? false,
            isBroadcast: $data['broadcast'] ?? false,
            photo: $data['photo']['photo_id'] ?? null,
            isVerified: $data['verified'] ?? false,
            isRestricted: $data['restricted'] ?? false,
            isScam: $data['scam'] ?? false,
            isFake: $data['fake'] ?? false,
            accessHash: $data['access_hash'] ?? null,
            participantsCount: $data['participants_count'] ?? null
        );
    }
}
