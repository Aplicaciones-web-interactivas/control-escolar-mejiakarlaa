<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Usuario;
use App\Models\Grupo;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $maestroId = request('maestro_id', 1);
        $maestro   = Usuario::findOrFail($maestroId);
        $tareas    = Tarea::with(['grupo', 'entregas'])
                          ->where('maestro_id', $maestroId)
                          ->latest()
                          ->get();

        return view('tareas.index', compact('tareas', 'maestro'));
    }

    public function create()
    {
        $maestroId = request('maestro_id', 1);
        $maestro   = Usuario::findOrFail($maestroId);
        $grupos    = Grupo::where('maestro_id', $maestroId)->get();

        return view('tareas.create', compact('grupos', 'maestro'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'grupo_id'      => 'required|exists:grupos,id',
            'maestro_id'    => 'required|exists:usuarios,id',
        ]);

        Tarea::create($request->only(
            'titulo', 'descripcion', 'fecha_entrega', 'grupo_id', 'maestro_id'
        ));

        return redirect("/tareas?maestro_id={$request->maestro_id}")
                   ->with('success', 'Tarea creada correctamente.');
    }

    public function verEntregas(Tarea $tarea)
    {
        $tarea->load(['grupo', 'maestro', 'entregas.alumno']);
        return view('tareas.entregas', compact('tarea'));
    }
}
