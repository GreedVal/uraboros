<?php

namespace App\Telegram\DTO\Request;

class GetFullInfoRequestDTO
{
    public function __construct(
        public string $name = '',
    ) {}
}
