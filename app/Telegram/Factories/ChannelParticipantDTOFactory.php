<?php

namespace App\Telegram\Factories;


use App\Telegram\Factories\UserDTOFactory;
use App\Telegram\DTO\Response\Participants\ChannelParticipantDTO;

class ChannelParticipantDTOFactory
{
    public static function createFromArray(array $data, ?array $userData = null): ChannelParticipantDTO
    {
        $user = $userData ? UserDTOFactory::createFromArray($userData) : null;

        return new ChannelParticipantDTO(
            type: $data['_'] ?? '',
            userId: $data['user_id'] ?? 0,
            date: $data['date'] ?? 0,
            user: $user
        );
    }
}
