<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("administrador.evento.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'titulo' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Reglas de validación para la imagen
        ]);    

        $imageName = $request->file('imagen')->getClientOriginalName();

        $request->file('imagen')->storeAs('imagenperfil', $imageName, 'public');

        $perfilData = [
            'imagen' => 'imagenperfil/' . $imageName,
        ];


        if ($request->filled('titulo')) {
            $perfilData['titulo'] = $request->input('titulo');
        }
        
        Evento::create($perfilData);
    
        return redirect()->route('evento.index')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
