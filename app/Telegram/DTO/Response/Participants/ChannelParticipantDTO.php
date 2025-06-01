<?php

namespace App\Telegram\DTO\Response\Participants;

class ChannelParticipantDTO
{
    public function __construct(
        public string $type,
        public int $userId,
        public int $date,
        public ?UserDTO $user = null,
    ) {}
}
