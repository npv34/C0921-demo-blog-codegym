<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('login.html', [\App\Http\Controllers\Admin\LoginController::class, 'showFormLogin'])->name('admin.showFormLogin');
    Route::post('login.html', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

    Route::middleware('auth')->group(function (){
        Route::get('dashboard.html', [\App\Http\Controllers\Admin\HomeController::class,'showDashboard'])->name('admin.showDashboard');
        Route::get('logout', [\App\Http\Controllers\Admin\LoginController::class,'logout'])->name('admin.logout');

        Route::prefix('posts')->group(function (){
            Route::get('', [\App\Http\Controllers\Admin\PostController::class,'index'])->name('admin.posts.index');
            Route::get('list', [\App\Http\Controllers\Admin\PostController::class,'getList']);
            Route::get('create.html', [\App\Http\Controllers\Admin\PostController::class,'create'])->name('admin.posts.create');
            Route::post('create.html', [\App\Http\Controllers\Admin\PostController::class,'store'])->name('admin.posts.store');
            Route::post('delete.html', [\App\Http\Controllers\Admin\PostController::class,'delete']);
            Route::post('search.html', [\App\Http\Controllers\Admin\PostController::class,'search']);
        });
    });
});
