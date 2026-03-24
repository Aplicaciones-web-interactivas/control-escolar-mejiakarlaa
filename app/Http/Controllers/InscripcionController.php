<?php

namespace App\Http\Controllers;
use App\Models\Inscripcion;
use App\Models\Usuario;
use App\Models\Grupo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with('alumno','grupo')->get();
        return view('inscripciones.index', compact('inscripciones'));
    }

    public function create()
    {
        $alumnos = Usuario::where('activo',1)->get();
        $grupos = Grupo::all();

        return view('inscripciones.create', compact('alumnos','grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required',
            'usuario_id' => 'required',
            'fecha_inscripcion' => 'required'
        ]);

        Inscripcion::create($request->all());

        return redirect('/inscripciones')->with('success','Guardado');
    }
}