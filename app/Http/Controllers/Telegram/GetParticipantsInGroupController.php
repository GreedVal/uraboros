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
        $perPage = 50;
        $currentPage = $request->input('page', 1);

        $offset = ($currentPage - 1) * $perPage;

        $dto = new GetParticipantsRequestDTO(
            chatUsername: $request->chatUsername,
            filter: $request->filter,
            limit: $perPage,
            offset: $offset
        );

        $result = $this->telegramService->getUserByGroup($dto);

        if (is_array($result) && array_key_exists('error', $result)) {
            return redirect()->back()->with('status', $result['error']);
        }

        $totalPages = ceil($result['count'] / $perPage);

        $queryParams = [
            'chatUsername' => $request->chatUsername,
            'filter' => $request->filter,
        ];

        return view('telegram.get-user-group-result', [
            'count' => $result['count'],
            'participants' => $result['participants'] ?? null,
            'queryParams' => $queryParams,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'perPage' => $perPage
        ]);
    }
}
