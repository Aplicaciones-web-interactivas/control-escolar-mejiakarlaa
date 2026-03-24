<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;   
use App\Models\Grupo;     

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    protected $fillable = [
        'grupo_id',
        'usuario_id',
        'fecha_inscripcion'
    ];

    public function alumno()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
}