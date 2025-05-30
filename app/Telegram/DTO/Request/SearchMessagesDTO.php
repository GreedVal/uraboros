<?php

namespace App\Telegram\DTO\Request;

class SearchMessagesDTO
{
    public function __construct(
        public string $chatUsername,
        public string $query = '',
        public int|string|null $fromId = null,
        public int $minDate = 0,
        public int $maxDate = 0,
        public int $offsetId = 0,
        public int $addOffset = 0,
        public int $limit = 20,
        public int $maxId = 0,
        public int $minId = 0,
        public array $hash = [],
        public array $filter = ['_' => 'inputMessagesFilterEmpty']
    ) {}

    public function toArray(): array
    {
        return [
                'peer' => $this->chatUsername,
                'q' => $this->query,
                'from_id' => $this->fromId,
                'filter' => $this->filter,
                'min_date' => $this->minDate,
                'max_date' => $this->maxDate,
                'offset_id' => $this->offsetId,
                'add_offset' => $this->addOffset,
                'limit' => $this->limit,
                'max_id' => $this->maxId,
                'min_id' => $this->minId,
                'hash' => $this->hash,
        ];
    }
}
