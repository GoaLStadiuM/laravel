<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::domain('play.' . config('app.domain'))->group(function ()
{
    if (Auth::user()->id === 2)
    {
        Route::get('/penalties', [ GameController::class, 'menu' ])->name('menu')->middleware(['auth']);
        Route::get('/penalties/shop', [ ShopController::class, 'shop' ])->name('shop')->middleware(['auth']);
    }
});
