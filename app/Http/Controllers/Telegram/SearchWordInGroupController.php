<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Search\SearchMessagesDTO;

class SearchWordInGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.search-word-group');

    }


public function search(Request $request)
{
    $page = $request->input('page', 1);
    $offset_id = $request->input('offset_id', 0);

    $dto = new SearchMessagesDTO(
        chatUsername: $request->chatUsername,
        query: $request['query'],
        offsetId: $offset_id,
        limit: 50
    );

    $result = $this->telegramService->getMessagesByWord($dto);

    $queryParams = [
        'chatUsername' => $request->chatUsername,
        'query' => $request['query']
    ];


    return view('telegram.search-word-group-result', [
        'count' => $result['count'],
        'chat' => $result['chat'],
        'messages' => $result['messages'],
        'currentPage' => $page,
        'totalPages' => ceil($result['count'] / 50),
        'queryParams' => $queryParams
    ]);
}
}
