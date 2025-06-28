<?php

namespace App\Telegram\DTO\Response\Messages;

class UserDTO
{
    public function __construct(
        public int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $username,
        public ?string $phone,
        public bool $isBot,
        public bool $isVerified,
        public bool $isPremium,
        public ?string $langCode,
        public ?array $photo
    ) {}
}
