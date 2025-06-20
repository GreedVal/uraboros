<?php

namespace App\Telegram\DTO\Response\Messages;

class PollDTO
{
    public function __construct(
        public string $id,
        public string $question,
        public array $options,
        public int $totalVoters,
        public bool $closed,
        public bool $multiple
    ) {}
}
