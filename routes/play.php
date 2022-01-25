<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::domain('play.' . config('app.domain'))->middleware(['verified'])->group(function ()
{
    Route::get('/penalties', [ GameController::class, 'menu' ])->name('menu');
    Route::get('/penalties/shop', [ ShopController::class, 'shop' ])->name('shop');
    Route::post('/penalties/shop/purchase', [ ShopController::class, 'purchase' ]);
    /* tmp routes for testing*/
    Route::middleware('admin')->group(function () {
        Route::get('/penalties/play', [ GameController::class, 'play' ]);
        Route::get('/penalties/characterlist', [ GameController::class, 'characterList' ]);
        Route::get('/penalties/kick/{character_id}', [ GameController::class, 'kick' ]);
        Route::get('/penalties/kick/reward/{character_id}', [ GameController::class, 'kickReward' ]);
    });
});
