<?php

namespace App\Telegram\DTO\Response;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $firstName,
        public ?string $lastName,
        public ?string $username
    ) {}
}
