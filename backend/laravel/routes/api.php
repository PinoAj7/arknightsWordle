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

Route::get('/users', [UserController::class, 'index'])->middleware(['auth:sanctum', 'admin']);

Route::get('/users/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum', 'admin']);

Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'admin']);

Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum', 'admin']);

Route::get('/scores', [ScoreController::class, 'index'])->middleware('auth:sanctum');

Route::post('/scores', [ScoreController::class, 'store'])->middleware('auth:sanctum');

Route::get('/scores/user', [ScoreController::class, 'myScores'])->middleware('auth:sanctum');
