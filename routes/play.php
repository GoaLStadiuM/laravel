<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::domain('play.' . config('app.domain'))->group(function ()
{
    Route::get('/penalties', [ GameController::class, 'menu' ])->name('menu')->middleware(['auth']);
    Route::get('/penalties/shop/characters', [ ShopController::class, 'shop' ])->name('shop')->middleware(['auth']);
});
