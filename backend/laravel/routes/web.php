<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('game');
})->name('game');

Route::get('/auth', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/scoreboard', [ScoreController::class, 'show'])->middleware('auth')->name('scoreboard');

Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');

Route::get('/admin/users', [UserController::class, 'indexView'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'createView'])->middleware(['auth'])->name('admin.users.create');
Route::post('/admin/users/store', [UserController::class, 'store'])->middleware(['auth'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'editView'])->middleware(['auth'])->name('admin.users.edit');
Route::put('/admin/users/{id}/update', [UserController::class, 'update'])->middleware(['auth'])->name('admin.users.update');
Route::delete('/admin/users/{id}/delete', [UserController::class, 'destroy'])->middleware(['auth'])->name('admin.users.destroy');

Route::get('/admin/characters', [CharacterController::class, 'indexView'])->name('admin.characters.index');
Route::get('/admin/characters/create', [CharacterController::class, 'createView'])->middleware(['auth'])->name('admin.characters.create');
Route::post('/admin/characters/store', [CharacterController::class, 'store'])->middleware(['auth'])->name('admin.characters.store');
Route::get('/admin/characters/{id}/edit', [CharacterController::class, 'editView'])->middleware(['auth'])->name('admin.characters.edit');
Route::put('/admin/characters/{id}/update', [CharacterController::class, 'update'])->middleware(['auth'])->name('admin.characters.update');
Route::delete('/admin/characters/{id}/delete', [CharacterController::class, 'destroy'])->middleware(['auth'])->name('admin.characters.destroy');

Route::get('/dashboard', function () {
    return redirect('/'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
