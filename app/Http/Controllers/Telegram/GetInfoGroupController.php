<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\DTO\Request\GetFullInfoRequestDTO;
use App\Telegram\Services\TelegramService;

class GetInfoGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {

        return view('telegram.get-info-group');

    }

    public function search(Request $request) {

        $dto = new GetFullInfoRequestDTO(
            name: $request->chatUsername
        );

        $result = $this->telegramService->getInfoGroup($dto);

        if (is_array($result) && array_key_exists('error', $result)) {
            return redirect()->back()->with('status', $result['error']);
        }

        return view('telegram.get-info-group-result', [
            'chat' => $result[0] ?? null,
        ]);
    }
}
