<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\News\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');
Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('auth');

Route::get('test', function () {
    return phpinfo();
});


require __DIR__.'/auth.php';
