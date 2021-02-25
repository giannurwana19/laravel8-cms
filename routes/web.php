<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('posts', PostController::class);
    Route::resource('tags', TagController::class);

    Route::get('trashed-posts', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('restore-post/{id}', [PostController::class, 'restore'])->name('posts.restore');
});










// h: DOKUMETNASI

// verifyCategoryCount adalah middleware buatan kita, setelah itu daftarkan di kernel.php
// untuk memastikan category sudah ada sebelum post dibuat
// Route::resource('posts', PostController::class)->middleware('verifyCategoryCount');
// pada kasus ini kita menerapkan middleware verifyCategoryCount di constructor PostController
