<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/characters', [CharacterController::class, 'index']);

Route::get('/characters/{id}', [CharacterController::class, 'show']);

Route::post('/characters', [CharacterController::class, 'store'])
    ->middleware(['auth:sanctum']);

Route::put('/characters/{id}', [CharacterController::class, 'update'])
    ->middleware(['auth:sanctum']);

Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])
    ->middleware(['auth:sanctum']);

Route::get('/users', [UserController::class, 'index'])->middleware(['auth:sanctum']);

Route::post('/users', [UserController::class, 'store'])->middleware(['auth:sanctum']);

Route::get('/users/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum']);

Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['auth:sanctum']);

Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum']);

Route::get('/scores', [ScoreController::class, 'index'])->middleware('auth:sanctum');

Route::post('/scores', [ScoreController::class, 'store'])->middleware('auth:sanctum');

Route::get('/scores/user/{userId}', [ScoreController::class, 'myScores'])->middleware('auth:sanctum');

