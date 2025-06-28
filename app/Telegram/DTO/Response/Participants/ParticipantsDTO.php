<?php

namespace App\Telegram\DTO\Response\Participants;

class ParticipantsDTO
{
    public function __construct(
        public string $type,
        public int $count,
        /** @var ChannelParticipantDTO[] */
        public array $participants,
        /** @var array */
        public array $chats,
        /** @var UserDTO[] */
        public array $users,
    ) {}
}
