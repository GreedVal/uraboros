<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Request\GetParticipantsRequestDTO;

class GetParticipantsInGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.get-user-group');

    }

    public function search(Request $request) {

        $dto = new GetParticipantsRequestDTO(
            chatUsername: $request->chatUsername,
            filter: $request->filter,
            limit: 50,
        );

        $result = $this->telegramService->getUserByGroup($dto);

        dd($result);
        return view('telegram.get-user-group-result', [
            'count' => $result['count'],
            'participants' => $result['participants'] ?? null,
            'currentPage' => 1,
            'totalPages' => 2,
        ]);
    }
}
