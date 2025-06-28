<?php

namespace App\Telegram\DTO\Response\Messages;

class ContactDTO
{
    public function __construct(
        public string $phone,
        public string $firstName,
        public ?string $lastName,
        public ?int $userId
    ) {}
}
