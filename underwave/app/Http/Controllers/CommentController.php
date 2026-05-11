<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        // Nos devuelve a la misma página del post
        return back();
    }
}