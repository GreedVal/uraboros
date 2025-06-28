<?php

namespace App\Telegram\DTO\Response\Messages;

class VoiceDTO
{
    public function __construct(
        public string $id,
        public float $duration,
        public int $size,
        public string $mimeType,
        public string $waveform
    ) {}
}
