<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Telegram\SearchUserInGroupController;
use App\Http\Controllers\Telegram\SearchWordInGroupController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('telegram')->name('telegram.')->group(function () {

    Route::get('/search-word-group', [SearchWordInGroupController::class, 'index'])->name('search-word-group');
    Route::get('/search-word-group/result', [SearchWordInGroupController::class, 'search'])->name('search-word-group.result');

    Route::get('/search-user-group', [SearchUserInGroupController::class, 'index'])->name('search-user-group');
    Route::get('/search-user-group/result', [SearchWordInGroupController::class, 'search'])->name('search-user-group.result');

});
