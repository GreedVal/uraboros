<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Request\ParticipantsRequestDTO;

class GetParticipantsInGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.get-user-group');

    }

    public function search(Request $request) {

        $dto = new ParticipantsRequestDTO(
            chatUsername: $request->chatUsername,
            filter: $request->filter,
            limit: 20,
        );

        $result = $this->telegramService->getUserByGroup($dto);

        print_r($result);

    }
}
