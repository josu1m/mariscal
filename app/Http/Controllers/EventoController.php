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
        $eventos = Evento::all();

        return view("administrador.evento.index", compact('eventos'));
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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Reglas de validación para la imagen
        ]);

        // Verifica si se ha subido un archivo de imagen
        if ($request->hasFile('imagen')) {
            // Obtiene el nombre original del archivo
            $imageName = $request->file('imagen')->getClientOriginalName();

            // Almacena la imagen en el almacenamiento
            $request->file('imagen')->storeAs('imagenperfil', $imageName, 'public');

            // Prepara los datos del evento para la creación
            $perfilData = [
                'imagen' => 'imagenperfil/' . $imageName,
            ];
        } else {
            // Si no se subió ninguna imagen, establece el campo 'imagen' como nulo o vacío según tu necesidad
            $perfilData = [
                'imagen' => null, // O puedes establecerlo como una cadena vacía según tus necesidades
            ];
        }

        // Verifica si se proporcionó un título en el formulario
        if ($request->filled('titulo')) {
            $perfilData['titulo'] = $request->input('titulo');
        }

        // Crea el evento utilizando los datos preparados
        Evento::create($perfilData);

        // Redirige de vuelta a la página de eventos con un mensaje de éxito
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
        $evento->delete();
        return redirect()->route('evento.index')->with('success', 'Evento eliminado exitosamente.');
    }
}
