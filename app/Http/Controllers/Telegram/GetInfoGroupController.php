<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Telegram\Services\TelegramService;
use App\Telegram\DTO\Request\GetFullInfoRequestDTO;

class GetInfoGroupController extends Controller
{
    public function __construct(
        protected TelegramService $telegramService
    ) {}

    public function index() {


        $dto = new GetFullInfoRequestDTO(
            name: 'hh_kherson',
        );

        $result = $this->telegramService->getInfoGroup($dto);

        dd($result);
    }
}
