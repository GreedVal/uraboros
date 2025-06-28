<?php

namespace App\Telegram\DTO\Response\Participants;

class UserStatusDTO
{
    public function __construct(
        public string $type,
        public ?bool $byMe,
    ) {}
}
