<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware('admin')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.make-admin');
    });

    Route::patch('users/profile', [UserController::class, 'update'])->name('users.update-profile');
    Route::get('users/profile', [UserController::class, 'edit'])->name('users.edit-profile');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('posts', PostController::class);
    Route::resource('tags', TagController::class);

    Route::get('trashed-posts', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('restore-post/{id}', [PostController::class, 'restore'])->name('posts.restore');
});


Route::get('blog-posts', [BlogController::class, 'index'])->name('blogs.index');
Route::get('blog-posts/{post}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('blogs/categories/{category}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('blogs/tags/{tag}', [BlogController::class, 'tag'])->name('blogs.tag');







// h: DOKUMETNASI

// verifyCategoryCount adalah middleware buatan kita, setelah itu daftarkan di kernel.php
// untuk memastikan category sudah ada sebelum post dibuat
// Route::resource('posts', PostController::class)->middleware('verifyCategoryCount');
// pada kasus ini kita menerapkan middleware verifyCategoryCount di constructor PostController
