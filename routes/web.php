<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/login',[LoginController::class, 'authenticate'])->name('authenticate');

Route::post('/logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');
