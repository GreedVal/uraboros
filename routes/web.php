<?php

use App\Http\Controllers\Telegram\InfoGroupController;
use App\Http\Controllers\Telegram\ParticipantsController;
use App\Http\Controllers\Telegram\UserMessagesController;
use App\Http\Controllers\Telegram\WordMessagesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('telegram', function () {
    return Inertia::render('Telegram');
})->middleware(['auth', 'verified'])->name('telegram');


Route::middleware('auth')->prefix('telegram')->name('telegram')->group(function () {
    Route::get('/word-messages', WordMessagesController::class)->name('word-messages');
    Route::get('/user-messages', UserMessagesController::class)->name('user-messages');
    Route::get('/participants-group', ParticipantsController::class)->name('participants-group');
    Route::get('/info-group', InfoGroupController::class)->name('info-group');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
