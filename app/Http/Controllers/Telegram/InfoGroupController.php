<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\DTO\Request\GetFullInfoRequestDTO;
use App\Telegram\Services\TelegramService;
use Inertia\Inertia;

class InfoGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {
    }

    public function __invoke(Request $request)
    {
        $dto = new GetFullInfoRequestDTO(
            name: $request->input('query')
        );

        $result = $this->telegramService->getInfoGroup($dto);

        if (isset($result['error'])) {
            return back()
                ->withErrors([
                    'error' => $result['error'] ?? ''
                ])
                ->withInput([
                    'searchType' => $request->input('searchType', 'info')
                ]);
        }

        if ($result[0] === null) {
            return back()
                ->withErrors([
                    'error' => 'The group was not found'
                ])
                ->withInput([
                    'searchType' => $request->input('searchType', 'info')
                ]);
        }

        return Inertia::render('Telegram/InfoGroup', [
            'groups' => $result
        ]);
    }
}
