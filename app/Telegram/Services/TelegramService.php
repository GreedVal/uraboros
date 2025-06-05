<?php

namespace App\Telegram\Services;


use App\Telegram\DTO\Request\SearchMessagesDTO;
use App\Telegram\Actions\Request\GetFullInfoAction;
use App\Telegram\DTO\Request\GetFullInfoRequestDTO;
use App\Telegram\Actions\Request\SearchMessagesAction;
use App\Telegram\DTO\Request\GetParticipantsRequestDTO;
use App\Telegram\Actions\Request\GetGroupParticipantsAction;


class TelegramService
{
    public function __construct(
        protected SearchMessagesAction $searchMessagesAction,
        protected GetGroupParticipantsAction $getGroupParticipantsAction,
        protected GetFullInfoAction $getGroupInfoAction,
    ) {}

    public function getMessagesByWord(SearchMessagesDTO $dto): ?array
    {
        return $this->searchMessagesAction->execute($dto);
    }

    public function getMessagesByUser(SearchMessagesDTO $dto): ?array
    {
        return $this->searchMessagesAction->execute($dto);
    }

    public function getUserByGroup(GetParticipantsRequestDTO $dto): ?array
    {
        return $this->getGroupParticipantsAction->execute($dto);
    }

    public function getInfoGroup(GetFullInfoRequestDTO $dto): ?array
    {
        return $this->getGroupInfoAction->execute($dto);
    }
}
