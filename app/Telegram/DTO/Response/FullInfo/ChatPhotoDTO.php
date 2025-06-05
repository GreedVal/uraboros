<?php

namespace App\Telegram\DTO\Response\FullInfo;

class ChatPhotoDTO
{
    public function __construct(
        public string $photoId,
        public string $fileReference,
        public int $dcId
    ) {}
}
