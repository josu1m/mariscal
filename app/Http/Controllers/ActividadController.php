<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aquí puedes obtener los datos que deseas pasar a la vista
        $actividades = Actividad::all(); // Por ejemplo, supongamos que deseas pasar todas las actividades
    
        // Luego, puedes pasar los datos a la vista utilizando la función view()
        return view("administrador.actividad.index", compact('actividades'));
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
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_fin' => 'nullable|date',
        ]);
    
        // Si no se proporciona actividad_estado en el formulario, establecerlo como verdadero (true) por defecto
        $actividad_estado = $request->has('actividad_estado') ? $request->actividad_estado : true;
    
        // Crear una nueva instancia del modelo Actividad
        $actividad = new Actividad();
    
        // Asignar los valores del formulario al modelo
        $actividad->nombre = $request->nombre;
        $actividad->fecha_fin = $request->fecha_fin;
        $actividad->actividad_estado = $actividad_estado;
    
        // Guardar la actividad en la base de datos
        $actividad->save();
    
        // Redireccionar a alguna parte adecuada de tu aplicación
        return redirect()->route('pago.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Actividad $actividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        
        // Buscar la actividad por su ID
        $actividad = Actividad::findOrFail($id);
    
        // Actualizar los campos de la actividad
        $actividad->nombre = $request->nombre;
        $actividad->fecha_fin = $request->fecha_fin;
    
        // Verificar si la fecha de finalización ha pasado y actualizar el estado
        if ($actividad->fecha_fin && Carbon::parse($actividad->fecha_fin)->isPast()) {
            $actividad->actividad_estado = false;
        }
    
        // Guardar los cambios en la base de datos
        $actividad->save();
    
        // Redireccionar a alguna parte adecuada de tu aplicación
        return redirect()->route('actividad.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $actividad)
    {
        //
    }
}
