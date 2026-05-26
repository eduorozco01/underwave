<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        if (!Auth::user()->hasRole('Banda')) {
            abort(403, 'SYSTEM_ERROR: SOLO LAS BANDAS PUEDEN PUBLICAR EVENTOS.');
        }
        return view('posts.create');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('Banda')) {
            abort(403, 'SYSTEM_ERROR: SOLO LAS BANDAS PUEDEN PUBLICAR EVENTOS.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // Max 20MB image
            'audio' => 'nullable|file|mimes:mp3,wav,ogg|max:40960', // Max 40MB audio
            'event_date' => 'nullable|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Guarda la imagen y nos devuelve la ruta exacta
            $imagePath = $request->file('image')->store('post_images', 'public');
        }

        $audioPath = null;
        if ($request->hasFile('audio')) {
            // Guarda el audio y nos devuelve la ruta exacta
            $audioPath = $request->file('audio')->store('post_audios', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'category' => $request->category,
            'price_range' => $request->price_range,
            'event_date' => $request->event_date,
            'user_id' => Auth::id(),
            'image_path' => $imagePath, // Guardamos la ruta en la DB
            'audio_path' => $audioPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
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
            'event_date' => 'nullable|date',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'category' => $request->category,
            'event_date' => $request->event_date,
            'price_range' => $request->price_range,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'RECORD_UPDATED');
    }
}