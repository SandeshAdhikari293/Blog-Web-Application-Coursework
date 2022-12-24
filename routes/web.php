<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create_new'])->name('posts.create_new');
Route::post('/posts/store', [PostController::class, 'store'])->name("posts.store");
Route::get('/posts/{id}', [PostController::class, 'show'])->name("posts.show");
Route::get('/posts/user/{id}', [PostController::class, 'user'])->name("posts.users");

Route::post('/post/{id}/comment/store', [CommentController::class, 'store'])->name("comments.store");


require __DIR__.'/auth.php';
