<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::latest()->get();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
require __DIR__ . '/auth.php';

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');