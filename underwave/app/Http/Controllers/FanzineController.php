<?php

namespace App\Http\Controllers;

use App\Models\Fanzine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FanzineController extends Controller
{
    /**
     * Display a listing of the fanzines.
     */
    public function index()
    {
        $fanzines = Fanzine::with('user')->orderBy('created_at', 'desc')->get();
        return view('fanzines.index', compact('fanzines'));
    }

    /**
     * Show the form for creating a new fanzine.
     */
    public function create()
    {
        return view('fanzines.create');
    }

    /**
     * Store a newly created fanzine in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048', // 2MB
            'file'  => 'required|file|mimes:pdf|max:10240', // 10MB
        ]);

        $coverPath = $request->file('cover')->store('fanzines/covers', 'public');
        $filePath  = $request->file('file')->store('fanzines/files', 'public');

        Fanzine::create([
            'user_id'    => Auth::id(),
            'title'      => $validated['title'],
            'cover_path' => $coverPath,
            'file_path'  => $filePath,
        ]);

        return redirect()->route('fanzines.index')
            ->with('success', 'Fanzine publicado con éxito');
    }
}
?>
