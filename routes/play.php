<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::domain('play.' . config('app.domain'))->group(function ()
{
    Route::middleware('auth')->group(function () {
        Route::get('/penalties', [ GameController::class, 'menu' ])->name('menu');
        Route::get('/penalties/shop', [ ShopController::class, 'shop' ])->name('shop');
        Route::post('/penalties/shop/purchase', [ ShopController::class, 'purchase' ]);
        Route::get('/penalties/kick/{character_id}', [ GameController::class, 'kick' ])->middleware('throttle:1,1');
    });
});
