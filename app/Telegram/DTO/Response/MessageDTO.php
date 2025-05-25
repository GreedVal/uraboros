<?php

namespace App\Telegram\DTO\Response;

class MessageDTO
{
    public function __construct(
        public int $id,
        public int $fromId,
        public int $peerId,
        public ?int $replyToMsgId,
        public int $date,
        public string $text,
        public bool $isOutgoing,
        public ?UserDTO $user = null,
    ) {}
}
