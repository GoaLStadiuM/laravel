<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ShopController;

Route::domain('www.' . config('app.domain'))->group(function ()
{
    Route::get('/', [WebController::class, 'landing'])->name('landing');
    Route::get('/purchases', [ShopController::class, 'purchases'])->name('purchases')->middleware(['auth']);
    Route::get('/request-tokens/{id}', [ShopController::class, 'requestToken'])->name('request.tokens')->middleware(['auth']);
    Route::post('/sent/staking/presale', [ShopController::class, 'sentStakingPresale'])->name('sent.staking.presale')->middleware(['auth']);
    Route::view('/manualhash', 'shop.manualhash')->name('manualhash')->middleware(['auth']);
    Route::post('/manualhash/check', [ShopController::class, 'manualHash'])->name('manualhash.check')->middleware(['auth', 'throttle:5,.07']);
    Route::get('/team', [WebController::class, 'team'])->name('team');
    Route::get('/partner', [WebController::class, 'partner'])->name('partner');
    Route::get('/stake', [WebController::class, 'stake'])->name('stake');
    Route::get('/audits', [WebController::class, 'audits'])->name('audits');
    Route::get('/farming', [ShopController::class, 'farming'])->name('farming')->middleware(['auth']);
    Route::get('/farming/stats/{payment_id}', [ShopController::class, 'stats'])->name('stats')->middleware(['auth']);
    Route::get('/farming/select/training/{player_id}/{training_type}/{payment_id}', [ShopController::class, 'selectTraining'])->name('selectTraining')->middleware(['auth']);
    Route::get('/farming/claim-reward/{training_id}', [ShopController::class, 'claim'])->name('claim')->middleware(['auth']);

    // ADMIN ROUTES
    Route::get('/737679/out', [ShopController::class, 'payer']);
    Route::post('/737679/withdraw', [ShopController::class, 'payerPost']);
    Route::get('/testing', function() {
        phpinfo();
    });
});
