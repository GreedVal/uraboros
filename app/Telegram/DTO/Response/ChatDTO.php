<?php

namespace App\Telegram\DTO\Response;

class ChatDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $username,
        public bool $isMegagroup
    ) {}
}
