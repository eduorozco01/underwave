<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransmissionController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    // 1. Iniciamos la consulta a la base de datos
    $query = Post::query();

    // 2. Si el usuario hace clic en una categoría, filtramos por ella
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    // 3. Si el usuario escribe algo en el buscador, buscamos en título y contenido
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // 4. Obtenemos los resultados de 9 en 9, manteniendo los filtros en la URL
    $posts = $query->latest()->paginate(9)->withQueryString();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/transmisiones', [TransmissionController::class, 'index'])->name('transmissions.index');
    Route::post('/transmisiones', [TransmissionController::class, 'store'])->name('transmissions.store');

    Route::post('/posts/{post}/attend', function (\App\Models\Post $post) {
        auth()->user()->attendedEvents()->toggle($post->id);
        return back();
    })->name('posts.attend');
});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
require __DIR__ . '/auth.php';

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');