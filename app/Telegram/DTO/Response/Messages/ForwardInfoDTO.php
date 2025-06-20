<?php

namespace App\Telegram\DTO\Response\Messages;

class ForwardInfoDTO
{
    public function __construct(
        public ?int $originalDate,
        public ?int $originalChannelPost,
        public ?int $savedFromMsgId,
        public ?int $savedFromPeerId,
        public ?int $fromName,
        public ?bool $import,
        public ?bool $hidden
    ) {}
}
