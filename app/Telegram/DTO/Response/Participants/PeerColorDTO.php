<?php

namespace App\Telegram\DTO\Response\Participants;

class PeerColorDTO
{
    public function __construct(
        public string $type,
        public int $color,
        public ?string $backgroundEmojiId,
    ) {}
}
