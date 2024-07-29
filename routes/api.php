<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;

Route::post('/users', [UserController::class, 'create']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para autenticar usuários e obter tokens (caso esteja usando Laravel Sanctum)
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas.'], 401);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

// Grupo de rotas protegidas por autenticação Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/emails', [EmailController::class, 'store']);
    Route::get('/emails/{id}', [EmailController::class, 'show']);
    Route::put('/emails/{id}', [EmailController::class, 'update']);
    Route::get('/emails', [EmailController::class, 'index']);
    Route::delete('/emails/{id}', [EmailController::class, 'destroy']);
});
