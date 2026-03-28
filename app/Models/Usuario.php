<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nombre', 'tipo', 'activo'];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'usuario_id');
    }

    public function gruposComoMaestro()
    {
        return $this->hasMany(Grupo::class, 'maestro_id');
    }

    public function tareasAsignadas()
    {
        return $this->hasMany(Tarea::class, 'maestro_id');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class, 'alumno_id');
    }
}
