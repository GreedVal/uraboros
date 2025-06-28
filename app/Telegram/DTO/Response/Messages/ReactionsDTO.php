<?php

namespace App\Telegram\DTO\Response\Messages;

class ReactionsDTO
{
    public function __construct(
        public bool $canSeeList, // Может ли пользователь видеть список реакций
        public array $reactions, // Массив реакций
        public int $count, // Общее количество реакций
        public ?string $recentReaction // Последняя реакция
    ) {}
}
