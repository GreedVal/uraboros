<?php

namespace App\Telegram\DTO\Response\Participants;


class UserProfilePhotoDTO
{
    public function __construct(
        public string $type,
        public bool $hasVideo,
        public bool $personal,
        public string $photoId,
        public string $strippedThumb,
        public int $dcId,
    ) {}
}
