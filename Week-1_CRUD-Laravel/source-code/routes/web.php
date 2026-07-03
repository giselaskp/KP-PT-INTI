<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetController;

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [AssetController::class, 'index'])->middleware('auth');
Route::post('/assets', [AssetController::class, 'store']) ->middleware('auth') ->name('assets.store');
Route::put('/assets/{asset}', [AssetController::class, 'update']) ->middleware('auth') ->name('assets.update');
Route::delete('/assets/{asset}', [AssetController::class, 'destroy']) ->middleware('auth') ->name('assets.destroy');

Route::post('/logout', [AuthController::class, 'logout']);
