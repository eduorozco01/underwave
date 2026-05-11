<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        // Cargamos al usuario y todos sus posts ordenados por el más reciente
        $posts = $user->posts()->latest()->get();

        return view('users.show', compact('user', 'posts'));
    }
}