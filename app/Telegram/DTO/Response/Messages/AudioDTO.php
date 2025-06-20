<?php

namespace App\Telegram\DTO\Response\Messages;

class AudioDTO
{
    public function __construct(
        public string $id,
        public float $duration,
        public string $title,
        public string $performer,
        public int $size,
        public string $mimeType
    ) {}
}
