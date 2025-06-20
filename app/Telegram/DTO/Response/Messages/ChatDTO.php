<?php

namespace App\Telegram\DTO\Response\Messages;

class ChatDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $username,
        public string $type,
        public bool $isMegagroup = false,
        public bool $isBroadcast = false,
        public ?string $photo = null,
        public bool $isVerified = false,
        public bool $isRestricted = false,
        public bool $isScam = false,
        public bool $isFake = false,
        public ?string $accessHash = null,
        public ?string $participantsCount = null,
    ) {}
}
