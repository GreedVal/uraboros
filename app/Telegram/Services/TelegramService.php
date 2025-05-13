<?php

namespace App\Telegram\Services;

use App\Telegram\DTO\Search\SearchMessagesDTO;
use App\Telegram\DTO\Request\ParticipantsRequestDTO;
use App\Telegram\Actions\Search\SearchMessagesByUserAction;
use App\Telegram\Actions\Search\SearchMessagesByWordAction;
use App\Telegram\Actions\Request\GetGroupParticipantsAction;


class TelegramService
{
    public function __construct(
        protected SearchMessagesByWordAction $searchMessagesByWordAction,
        protected SearchMessagesByUserAction $searchMessagesByUserAction,
        protected GetGroupParticipantsAction $getGroupParticipantsAction,
    ) {}

    public function getMessagesByWord(SearchMessagesDTO $dto): ?array
    {
        return $this->searchMessagesByWordAction->execute($dto);
    }

    public function getMessagesByUser(SearchMessagesDTO $dto): ?array
    {
        return $this->searchMessagesByUserAction->execute($dto);
    }

    public function getUserByGroup(ParticipantsRequestDTO $dto): ?array
    {
        return $this->getGroupParticipantsAction->execute($dto);
    }
}
