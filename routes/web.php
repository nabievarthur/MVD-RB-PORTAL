<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Chief\ChiefController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Service\ServiceController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::patch('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');


    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user.index');


    // TODO: доделать роуты1232

    Route::view('/admin/news', 'pages.admin.news.index')->name('admin.news.index');
    Route::view('/admin/subdivision', 'pages.admin.subdivision.index')->name('admin.subdivision.index');
    Route::view('/admin/role', 'pages.admin.role.index')->name('admin.role.index');

});




Route::get('/chiefs',[ChiefController::class,'index'] )->name('chiefs.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');


require __DIR__.'/auth.php';
