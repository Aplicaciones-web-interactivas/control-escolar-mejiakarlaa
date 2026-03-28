<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = ['nombre', 'maestro_id'];

    public function maestro()
    {
        return $this->belongsTo(Usuario::class, 'maestro_id');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(
            Usuario::class,
            'inscripciones',
            'grupo_id',
            'usuario_id'
        );
    }
}
