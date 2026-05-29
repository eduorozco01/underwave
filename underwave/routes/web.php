<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransmissionController;
use App\Http\Controllers\FanzineController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    // 1. Inicio la consulta base para traer los posts (eventos/fanzines)
    $query = Post::query();

    // 2. Compruebo si he recibido una categoría por la URL y filtro la consulta
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    // 3. Buscador: busco coincidencias tanto en el título como en el contenido del post
    // Aquí tuve un poco de ayuda de la IA porque no estaba seguro de cómo hacer el OR correctamente con Laravel
    if ($request->has('search') && $request->search != '') {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // 4. Paginación: saco 9 resultados por página y mantengo los parámetros de la URL para que no se pierdan al cambiar de página
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
    // Fanzines routes
    Route::get('/fanzines', [FanzineController::class, 'index'])->name('fanzines.index');
    Route::get('/fanzines/create', [FanzineController::class, 'create'])->name('fanzines.create');
    Route::post('/fanzines', [FanzineController::class, 'store'])->name('fanzines.store');

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