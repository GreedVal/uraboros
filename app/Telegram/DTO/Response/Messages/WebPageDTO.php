<?php

namespace App\Telegram\DTO\Response\Messages;

class WebPageDTO
{
    public function __construct(
        public ?string $url,
        public ?string $displayUrl,
        public ?string $title,
        public ?string $description,
        public ?PhotoDTO $photo
    ) {}
}
