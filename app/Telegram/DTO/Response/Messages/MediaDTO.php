<?php

namespace App\Telegram\DTO\Response\Messages;

class MediaDTO
{
    public function __construct(
        public string $type,
        public ?PhotoDTO $photo = null,
        public ?DocumentDTO $document = null,
        public ?VideoDTO $video = null,
        public ?AudioDTO $audio = null,
        public ?VoiceDTO $voice = null,
        public ?StickerDTO $sticker = null,
        public ?LocationDTO $location = null,
        public ?ContactDTO $contact = null,
        public ?PollDTO $poll = null,
        public ?WebPageDTO $webpage = null,
        public ?string $caption = null,
    ) {}
}
