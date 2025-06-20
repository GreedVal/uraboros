<?php

namespace App\Telegram\DTO\Response\Messages;

class ReactionDTO
{
    public function __construct(
        public string $emoticon, // Эмодзи реакции
        public int $count, // Количество таких реакций
        public bool $chosen // Выбрана ли текущим пользователем
    ) {}
}
