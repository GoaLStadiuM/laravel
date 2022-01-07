<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\GameController;
use App\Models\Presale;

Route::domain('www.' . config('app.domain'))->group(function ()
{
    Route::get('/', [WebController::class, 'landing'])->name('landing');
    Route::get('/team', [WebController::class, 'team'])->name('team');
    Route::get('/partner', [WebController::class, 'partner'])->name('partner');
    Route::get('/stake', [WebController::class, 'stake'])->name('stake');
    Route::get('/audits', [WebController::class, 'audits'])->name('audits');
    // temp routes
    Route::get('/farming', [GameController::class, 'farmingWeb'])->name('farming')->middleware(['verified']);
    Route::get('/farming/stats/{payment_id}', [GameController::class, 'stats'])->name('stats')->middleware(['verified']);
    Route::get('/farming/select/training/{payment_id}/{session_id}', [GameController::class, 'selectTraining'])->name('selectTraining')->middleware(['verified']);
    Route::get('/farming/claim-reward/{training_id}', [GameController::class, 'claim'])->name('claim')->middleware(['verified']);
});
