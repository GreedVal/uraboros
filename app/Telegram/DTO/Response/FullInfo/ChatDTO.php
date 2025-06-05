<?php

namespace App\Telegram\DTO\Response\FullInfo;

class ChatDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $username,
        public bool $isMegagroup,
        public bool $isLeft,
        public bool $hasLink,
        public bool $joinToSend,
        public ?int $date,
        public ?int $participantsCount,
        public ?int $onlineCount,
        public ?string $about,
        public ?int $linkedChatId,
        public ?array $availableReactions,
        public ?ChatPhotoDTO $photo,
        public ?array $defaultBannedRights
    ) {}
}
