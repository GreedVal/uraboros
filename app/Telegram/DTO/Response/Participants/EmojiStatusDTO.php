<?php

namespace App\Telegram\DTO\Response\Participants;

class EmojiStatusDTO
{
    public function __construct(
        public string $type,
        public string $documentId,
    ) {}
}
