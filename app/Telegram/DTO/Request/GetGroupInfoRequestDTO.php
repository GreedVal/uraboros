<?php

namespace App\Telegram\DTO\Request;

class GetGroupInfoRequestDTO
{
    public function __construct(
        public string $chatUsername,
    ) {}
}
