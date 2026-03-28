<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function index()
    {
        $alumnoId = request('alumno_id', 1);
        $alumno   = Usuario::findOrFail($alumnoId);

        $tareas = Tarea::with(['grupo', 'entregas' => function ($q) use ($alumnoId) {
                            $q->where('alumno_id', $alumnoId);
                        }])
                       ->whereHas('grupo.inscripciones', function ($q) use ($alumnoId) {
                           $q->where('usuario_id', $alumnoId);
                       })
                       ->latest()
                       ->get();

        return view('entregas.index', compact('tareas', 'alumno'));
    }

    public function create(Tarea $tarea)
    {
        $alumnoId = request('alumno_id', 1);
        $alumno   = Usuario::findOrFail($alumnoId);

        $yaEntrego = Entrega::where('tarea_id', $tarea->id)
                            ->where('alumno_id', $alumnoId)
                            ->exists();

        if ($yaEntrego) {
            return redirect("/entregas?alumno_id={$alumnoId}")
                       ->with('error', 'Ya entregaste esta tarea.');
        }

        return view('entregas.create', compact('tarea', 'alumno'));
    }

    public function store(Request $request, Tarea $tarea)
    {
        $request->validate([
            'alumno_id'   => 'required|exists:usuarios,id',
            'archivo_pdf' => 'required|file|mimes:pdf|max:5120',
            'comentario'  => 'nullable|string|max:500',
        ]);

        $path = $request->file('archivo_pdf')
                        ->store("entregas/tarea_{$tarea->id}", 'public');

        Entrega::create([
            'tarea_id'    => $tarea->id,
            'alumno_id'   => $request->alumno_id,
            'archivo_pdf' => $path,
            'comentario'  => $request->comentario,
            'estado'      => 'entregado',
        ]);

        return redirect("/entregas?alumno_id={$request->alumno_id}")
                   ->with('success', 'Tarea entregada correctamente.');
    }

    public function verPdf(Entrega $entrega)
    {
        $ruta = storage_path("app/public/{$entrega->archivo_pdf}");

        if (!file_exists($ruta)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file($ruta, ['Content-Type' => 'application/pdf']);
    }

    public function marcarRevisada(Entrega $entrega)
    {
        $entrega->update(['estado' => 'revisado']);

        return redirect("/tareas/{$entrega->tarea_id}/entregas")
                   ->with('success', 'Entrega marcada como revisada.');
    }
}
