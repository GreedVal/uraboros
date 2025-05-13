<?php

namespace App\Telegram\DTO\Request;

class ParticipantsRequestDTO
{
    public function __construct(
        public string $chatUsername,
        public int $limit = 200,
        public int $offset = 0
    ) {}
}
