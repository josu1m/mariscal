<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Pago;
use Illuminate\Http\Request;
use App\Models\Estudiante;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cargar los pagos con las relaciones 'estudiante' y 'actividad' ordenados por fecha de creación de forma descendente
        $pagos = Pago::with(['estudiante', 'actividad'])->orderBy('created_at', 'desc')->get();
    
        return view("administrador.pago.index", compact('pagos'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        
        // Recuperar solo las actividades que están activas
        $actividads = Actividad::where('actividad_estado', true)->get();
        
        return view("administrador.pago.create", compact('estudiantes', 'actividads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'actividad_id' => 'required|exists:actividads,id',
        ]);
    
        // Inicializar un nuevo arreglo para almacenar los IDs de los estudiantes
        $estudiantesIds = [];
    
        // Verificar si se seleccionaron todos los estudiantes
        if ($request->filled('estudiante_id') && in_array('seleccionar_todos', $request->estudiante_id)) {
            // Obtener los IDs de todos los estudiantes y agregarlos al arreglo
            $estudiantesIds = Estudiante::pluck('id')->all();
        } else {
            // Si no se seleccionaron todos los estudiantes, agregar los IDs seleccionados al arreglo
            $estudiantesIds = $request->input('estudiante_id', []);
        }
    
        // Crear nuevos pagos
        foreach ($estudiantesIds as $estudianteId) {
            $pago = new Pago();
            $pago->actividad_id = $request->actividad_id;
            $pago->estudiante_id = $estudianteId;
            $pago->monto = $request->monto;
            $pago->descripcion = $request->descripcion;
            $pago->save();
        }
    
        // Redireccionar a alguna parte adecuada de tu aplicación
        return redirect()->route('pago.index');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Pago $pagos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $pago = Pago::find($id);

        return view('administrador.pago.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        $pago->update([
            'pagado' => $request->pagado
        ]);
        // Validar los datos
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'pagado' => 'required|boolean',
        ]);

        // Actualizar el pago
        $pago->update([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'pagado' => $request->pagado,
        ]);

        // Redireccionar a alguna parte adecuada de tu aplicación
        return redirect()->route('pago.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pagos)
    {
        //
    }
}
