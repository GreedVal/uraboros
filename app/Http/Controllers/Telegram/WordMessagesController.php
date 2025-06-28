<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Request\SearchMessagesDTO;
use Inertia\Inertia;


class WordMessagesController extends Controller
{

    public function __construct(
        protected TelegramService $telegramService
    ) {
    }

    public function __invoke(Request $request)
    {

        $page = $request->input('page', 1);
        $offset_id = $request->input('offsetId', 0);


        $dto = new SearchMessagesDTO(
            chatUsername: $request->name,
            query: (string) $request['query'] ?? '',
            offsetId: $offset_id,
            limit: 20
        );

        $result = $this->telegramService->getMessagesByWord($dto);



        if (isset($result['error'])) {
            return back()
                ->withErrors([
                    'error' => $result['error'] ?? ''
                ])
                ->withInput([
                    'searchType' => $request->input('searchType', 'info')
                ]);
        }

        $totalPages = ceil($result['count'] / 20) ?? null;

        $lastMessageId = 0;
        if (!empty($result['messages'])) {
            $lastMessage = end($result['messages']);
            $lastMessageId = $lastMessage->id; // Получаем ID через свойство объекта
        }

        $queryParams = [
            'name' => $request->name,
            'query' => $request['query'],
            'offsetId' => $lastMessageId,
            'page' => (int) $page,

        ];

        return Inertia::render('Telegram/WordMessages', [
            'data' => $result,
            'queryParams' => $queryParams,
            'totalPages' => (int) $totalPages,
        ]);

    }


}
