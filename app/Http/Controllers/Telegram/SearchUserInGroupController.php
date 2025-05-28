<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Search\SearchMessagesDTO;

class SearchUserInGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.search-user-group');

    }

    public function search(Request $request) {

        $page = $request->input('page', 1);
        $offset_id = $request->input('offsetId', 0);

        $dto = new SearchMessagesDTO(
            chatUsername: $request->chatUsername,
            fromId: $request['query'],
            offsetId: $offset_id,
            limit: 20
        );

        $result = $this->telegramService->getMessagesByWord($dto);

        if (is_array($result) && array_key_exists('error', $result)) {
            return redirect()->back()->with('status', $result['error']);
        }

        $lastMessageId = 0;
        if (!empty($result['messages'])) {
            $lastMessage = end($result['messages']);
            $lastMessageId = $lastMessage->id;
        }

        $queryParams = [
            'chatUsername' => $request->chatUsername,
            'query' => $request['query'],
            'offsetId' => $lastMessageId
        ];

        return view('telegram.search-user-group-result', [
            'count' => $result['count'],
            'chat' => $result['chat'] ?? null,
            'messages' => $result['messages'] ?? null,
            'currentPage' => $page ?? null,
            'totalPages' => ceil($result['count'] / 20) ?? null,
            'queryParams' => $queryParams ?? null
        ]);

    }
}
