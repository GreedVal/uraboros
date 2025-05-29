<?php

namespace App\Telegram\DTO\Request;

use App\Telegram\Enum\ChannelParticipantsFilter;

class ParticipantsRequestDTO
{
    public function __construct(
        public string $chatUsername,
        public ChannelParticipantsFilter $filter,
        public int $limit = 200,
        public int $offset = 0,
        public array $hash = []
    ) {}

    public function toArray(): array
    {
        return [
            'channel' => $this->chatUsername,
            'filter' => ['_' => $this->filter->value],
            'limit' => $this->limit,
            'offset' => $this->offset,
            'hash' => $this->hash,
        ];
    }
}
