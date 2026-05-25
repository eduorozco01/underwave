<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transmission;

class TransmissionController extends Controller
{
    public function index()
    {
        // Cargamos las transmisiones más recientes e incluimos la relación con el usuario para evitar consultas N+1
        $transmissions = Transmission::with('user')->latest()->paginate(15);
        
        return view('transmissions.index', compact('transmissions'));
    }

    public function store(Request $request)
    {
        // Validamos que el mensaje sea obligatorio y no supere los 280 caracteres
        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        // Creamos la transmisión vinculada al usuario autenticado
        auth()->user()->transmissions()->create([
            'content' => $request->content,
        ]);

        return redirect()->route('transmissions.index')->with('success', '¡TRANSMISIÓN LANZADA CON ÉXITO AL RADAR!');
    }
}
