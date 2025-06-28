<?php

namespace App\Telegram\DTO\Response\Messages;

class PhotoDTO
{
    public function __construct(
        public string $id,
        public array $sizes,
        public int $date,
        public int $dcId,
        public bool $hasStickers
    ) {}
}
