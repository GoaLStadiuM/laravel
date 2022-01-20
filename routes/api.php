<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ShopController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::domain('auth.' . config('app.domain'))->group(function ()
{
    Route::post('/sanctum/token', function (Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [ 'The provided credentials are incorrect.' ],
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken($request->device_name)->plainTextToken,
            '' => csrf_token()
        ], 201);
    });

    Route::post('/sanctum/token/revoke', fn() => Auth::user()->currentAccessToken()->delete())
            ->middleware('auth:sanctum');
});

Route::domain('play.' . config('app.domain'))->middleware(['auth:sanctum','validated'])->group(function ()
{
    Route::get('/penalties/play', [ GameController::class, 'play' ]);
    Route::get('/penalties/characterlist', [ GameController::class, 'characterList' ]);
    Route::get('/penalties/kick/{character_id}', [ GameController::class, 'kick' ]);
    Route::get('/penalties/kick/reward/{character_id}', [ GameController::class, 'reward' ]);
});
