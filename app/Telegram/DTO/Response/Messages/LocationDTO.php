<?php

namespace App\Telegram\DTO\Response\Messages;

class LocationDTO
{
    public function __construct(
        public float $lat,
        public float $long,
        public ?int $accuracyRadius
    ) {}
}
