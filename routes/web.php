<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Telegram\SearchWordInGroupController;

Route::get('/', function () {
    return view('home');
});

Route::prefix('telegram')->name('telegram.')->group(function () {

    Route::get('/search-word-group', [SearchWordInGroupController::class, 'index'])->name('search-word-group');

});
