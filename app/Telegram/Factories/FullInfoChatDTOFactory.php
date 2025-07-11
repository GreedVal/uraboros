<?php

namespace App\Telegram\Factories;

use App\Telegram\DTO\Response\FullInfo\ChatDTO;
use App\Telegram\DTO\Response\FullInfo\ChatPhotoDTO;


class FullInfoChatDTOFactory
{
    public static function createFromArray(array $data): ?ChatDTO
    {

        $photo = isset($data['Chat']['photo'])
            ? new ChatPhotoDTO(
                $data['Chat']['photo']['photo_id'] ?? 0,
                $data['Chat']['photo']['stripped_thumb']->bytes ?? '',
                $data['Chat']['photo']['dc_id'] ?? 0
            )
            : null;

        return isset($data['Chat']) ? new ChatDTO(
            $data['Chat']['id'],
            $data['Chat']['title'] ?? null,
            $data['Chat']['username'] ?? null,
            (bool)($data['Chat']['megagroup'] ?? false),
            (bool)($data['Chat']['has_link'] ?? false),
            (bool)($data['Chat']['join_to_send'] ?? false),
            $data['Chat']['date'] ?? null,
            $data['full']['participants_count'] ?? null,
            $data['full']['online_count'] ?? null,
            $data['full']['about'] ?? null,
            $data['full']['linked_chat_id'] ?? null,
            $data['full']['available_reactions']['reactions'] ?? [],
            $photo,
            $data['Chat']['default_banned_rights'] ?? null
        ) : null;
    }
}
