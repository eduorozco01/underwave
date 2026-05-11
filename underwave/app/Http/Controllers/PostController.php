<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'category' => $request->category,
            'price_range' => $request->price_range,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Post creado correctamente');
    }
    public function destroy(Post $post)
    {
        // Medida de seguridad: ¿Es el usuario actual el dueño del post?
        if ($post->user_id !== Auth::id()) {
            abort(403, 'SYSTEM_ERROR: PERMISO DENEGADO.');
        }

        $post->delete();

        return redirect()->route('dashboard');
    }
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'SYSTEM_ERROR: PERMISO DENEGADO.');
        }
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'SYSTEM_ERROR: PERMISO DENEGADO.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'category' => $request->category,
            'price_range' => $request->price_range,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'RECORD_UPDATED');
    }
}