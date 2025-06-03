<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/characters', [CharacterController::class, 'index'])->middleware('auth:sanctum');

Route::get('/characters/{id}', [CharacterController::class, 'show'])->middleware('auth:sanctum');

Route::post('/characters', [CharacterController::class, 'store'])
    ->middleware(['auth:sanctum', 'admin']);

Route::put('/characters/{id}', [CharacterController::class, 'update'])
    ->middleware(['auth:sanctum', 'admin']);

Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])
    ->middleware(['auth:sanctum', 'admin']);
