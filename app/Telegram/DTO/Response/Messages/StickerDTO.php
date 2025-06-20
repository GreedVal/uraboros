<?php

namespace App\Telegram\DTO\Response\Messages;
class StickerDTO
{
    public function __construct(
        public string $id,
        public string $alt,
        public ?string $stickerSetId,
        public ?PhotoDTO $thumbnail
    ) {}
}
