<?php

namespace App\Telegram\Actions\Request;

use App\Telegram\Actions\AbstractTelegramAction;
use App\Telegram\DTO\Request\GetParticipantsRequestDTO;
use App\Telegram\Factories\ChannelParticipantDTOFactory;

class GetGroupParticipantsAction extends AbstractTelegramAction
{
    public function execute(GetParticipantsRequestDTO $dto): array
    {
        try {
            $response = $this->madeline()->channels->getParticipants($dto->toArray());
            return $this->processResponse($response);
        } catch (\Exception $e) {
            //Log::error("Error in GetGroupParticipantsAction: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    protected function processResponse(array $response): array
    {
        $result = [
            'count' => $response['count'] ?? 0,
            'participants' => [],
        ];


        $usersMap = [];
        foreach ($response['users'] ?? [] as $user) {
            $usersMap[$user['id']] = $user;
        }

        foreach ($response['participants'] ?? [] as $participant) {
            $userId = $participant['user_id'] ?? null;
            $userData = $userId ? ($usersMap[$userId] ?? null) : null;

            $result['participants'][] = ChannelParticipantDTOFactory::createFromArray(
                $participant,
                $userData
            );
        }

        return $result;
    }
}
