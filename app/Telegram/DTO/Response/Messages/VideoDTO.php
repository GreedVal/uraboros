<?php

namespace App\Telegram\DTO\Response\Messages;

class VideoDTO
{
    public function __construct(
        public string $id,
        public float $duration,
        public int $width,
        public int $height,
        public ?int $size,
        public string $mimeType,
        public ?int $thumbnail,
        public bool $supportsStreaming,
        public bool $isRound
    ) {}
}
