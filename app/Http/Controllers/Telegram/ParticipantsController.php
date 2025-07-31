<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Request\GetParticipantsRequestDTO;
use Inertia\Inertia;


class ParticipantsController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {
    }

    public function __invoke(Request $request)
    {
        $perPage = 50;
        $page = $request->input('page', 1);

        $offset = ($page - 1) * $perPage;

        $dto = new GetParticipantsRequestDTO(
            chatUsername: $request->name,
            filter: $request->filter,
            limit: $perPage,
            offset: $offset
        );

        $result = $this->telegramService->getUserByGroup($dto);

        if (isset($result['error'])) {
            return back()
                ->withErrors([
                    'error' => $result['error'] ?? ''
                ])
                ->withInput([
                    'searchType' => $request->input('searchType', 'info')
                ]);
        }

        $totalPages = ceil($result['count'] / $perPage);

        $queryParams = [
            'name' => $request->name,
            'filter' => $request->filter,
            'page' => (int) $page,
        ];

        return Inertia::render('telegram/ParticipantsGroup', [
            'count' => $result['count'],
            'participants' => $result['participants'] ?? null,
            'queryParams' => $queryParams,
            'totalPages' => (int) $totalPages,
        ]);
    }


}
