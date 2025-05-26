<?php

namespace App\Telegram\DTO\Search;

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
}
