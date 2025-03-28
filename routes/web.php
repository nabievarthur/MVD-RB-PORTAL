<?php

use App\Http\Controllers\Chief\ChiefController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');

Route::get('/chiefs',[ChiefController::class,'index'] )->name('chiefs.index');


require __DIR__.'/auth.php';
