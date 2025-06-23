<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OVD\OVDController;
use App\Http\Controllers\Admin\Subdivision\SubdivisionController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/***
 *Роуты для админа
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth'],function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('ovd', [OVDController::class, 'index'])->name('admin.ovd.index');
    Route::post('ovd', [OVDController::class, 'store'])->name('admin.ovd.store');
    Route::get('ovd/{ovd}', [OVDController::class, 'edit'])->name('admin.ovd.edit');
    Route::patch('ovd/{ovd}', [OVDController::class, 'update'])->name('admin.ovd.update');
    Route::delete('ovd/{ovd}', [OVDController::class, 'destroy'])->name('admin.ovd.destroy');

    Route::get('subdivisions', [SubdivisionController::class, 'index'])->name('admin.subdivision.index');
    Route::post('subdivisions', [SubdivisionController::class, 'store'])->name('admin.subdivision.store');
    Route::get('subdivisions/{subdivision}', [SubdivisionController::class, 'edit'])->name('admin.subdivision.edit');
    Route::patch('subdivisions/{subdivision}', [SubdivisionController::class, 'update'])->name('admin.subdivision.update');
    Route::delete('subdivisions/{subdivision}', [SubdivisionController::class, 'destroy'])->name('admin.subdivision.destroy');

    Route::view('/news', 'pages.admin.news.index')->name('admin.news.index');

    Route::view('/role', 'pages.admin.role.index')->name('admin.role.index');
});
