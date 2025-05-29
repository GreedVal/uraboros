<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\Enum\ChannelParticipantsFilter;
use App\Telegram\DTO\Request\ParticipantsRequestDTO;

class GetUserInGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.get-user-group');

    }

    public function search(Request $request) {

        $dto = new ParticipantsRequestDTO(
            chatUsername: 'DimBandera',
            filter: ChannelParticipantsFilter::ADMINS,
            limit: 10,
            offset: 0
        );

        $result = $this->telegramService->getUserByGroup($dto);

        print_r($result);

    }
}
