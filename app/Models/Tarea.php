<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'fecha_entrega', 'grupo_id', 'maestro_id'
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function maestro()
    {
        return $this->belongsTo(Usuario::class, 'maestro_id');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
