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



Route::get('/posts/page/{page}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name("posts.store");

Route::get('/posts/{id}', [PostController::class, 'show'])->name("posts.show");

Route::get('/posts/user/{id}', [PostController::class, 'user'])->name("posts.users");

Route::post('/post/{id}/comment/store', [CommentController::class, 'store'])->name("comments.store");
Route::post('/post/{id}/comment/store', [CommentController::class, 'store'])->name("comments.store");

Route::get('/post/{id}', [PostController::class, 'destroy'])->name("posts.destroy");

Route::get('/post/{p_id}/comment/{c_id}/destroy', [CommentController::class, 'destroy'])->name("comments.destroy");
Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');



require __DIR__.'/auth.php';
