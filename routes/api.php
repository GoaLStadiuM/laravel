<?php

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

    return response([
        'user' => $user,
        'token' => $user->createToken($request->device_name)->plainTextToken
    ], Response::HTTP_CREATED);
});

Route::post('/sanctum/token/revoke', fn() => Auth::user()->currentAccessToken()->delete())
        ->middleware('auth:sanctum');
