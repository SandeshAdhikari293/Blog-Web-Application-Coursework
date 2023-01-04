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

Route::post('comments/{id}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/users/{id}/page/{ppage}/{cpage}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/page/{page}', [UserController::class, 'index'])->name('users.index');
Route::get('/users/profile/{id}', [UserController::class, 'profile'])->name('users.profile');



Route::get('/posts/page/{page}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/edit/{id}/store', [PostController::class, 'store_edit'])->name('posts.edit.store');

Route::post('/posts/store', [PostController::class, 'store'])->name("posts.store");
Route::post('/users/profile/store', [UserController::class, 'store_profile'])->name("users.profile.store");

Route::get('/posts/{id}/page/{page}', [PostController::class, 'show'])->name("posts.show");

Route::get('/posts/user/{id}', [PostController::class, 'user'])->name("posts.users");

Route::get('/post/{id}', [PostController::class, 'destroy'])->name("posts.destroy");

Route::get('/post/{p_id}/comment/{c_id}/destroy', [CommentController::class, 'destroy'])->name("comments.destroy");
Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');



require __DIR__.'/auth.php';
