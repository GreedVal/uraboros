<?php

namespace App\Telegram\DTO\Request;

class GroupInfoRequestDTO
{
    public function __construct(
        public string $chatUsername,
    ) {}
}
