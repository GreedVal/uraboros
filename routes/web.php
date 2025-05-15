<?php

use Illuminate\Support\Facades\Route;
use App\Telegram\DTO\Search\SearchMessagesDTO;



Route::get('/', function () {
$dto = new SearchMessagesDTO(
    chatUsername: 'krim_chat',
    fromId: 'Luckyluckianno',
    limit: 2
);

$result = app(\App\Telegram\Services\TelegramService::class)
    ->getMessagesByUser($dto);

print_r($result);
});


Route::get('/', function () {
    return view('home');
});
