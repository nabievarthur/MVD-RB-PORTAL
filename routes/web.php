<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/create', [HomeController::class, 'create'])->name('create');



Route::get('/login',[LoginController::class, 'create'])->name('login');
