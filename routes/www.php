<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\GameController;

Route::domain('www.' . config('app.domain'))->group(function ()
{
    Route::get('/', [ WebController::class, 'home' ])->name('home');
    Route::get('/team', [ WebController::class, 'team' ])->name('team');
    Route::get('/collaborators', [ WebController::class, 'collaborators' ])->name('collaborators');
    Route::get('/rankings', [ WebController::class, 'rankings' ])->name('rankings');
    Route::get('/legal', [ WebController::class, 'legal' ])->name('legal');
    Route::get('/privacy', [ WebController::class, 'privacy' ])->name('privacy');
    Route::get('/cookies', [ WebController::class, 'cookies' ])->name('cookies');
    Route::get('/user', [ WebController::class, 'user' ])->name('user');
    // temp routes
    Route::get('/farming', [GameController::class, 'farmingWeb'])->name('farming')->middleware(['verified']);
    Route::get('/farming/stats/{payment_id}', [GameController::class, 'stats'])->name('stats')->middleware(['verified']);
    Route::get('/farming/select/training/{payment_id}/{session_id}', [GameController::class, 'selectTraining'])->name('selectTraining')->middleware(['verified']);
    Route::get('/farming/claim-reward/{training_id}', [GameController::class, 'claim'])->name('claim')->middleware(['verified']);
});
