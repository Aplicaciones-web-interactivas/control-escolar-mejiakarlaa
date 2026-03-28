@extends('layout')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>📋 Mis Tareas — {{ $maestro->nombre }}</h2>
    <a href="/tareas/create?maestro_id={{ $maestro->id }}" class="btn btn-primary">+ Nueva Tarea</a>
</div>

@if($tareas->isEmpty())
    <div class="card" style="text-align:center; color:#718096; padding:40px;">
        No has creado tareas aún.
    </div>
@else
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Grupo</th>
            <th>Fecha Límite</th>
            <th>Entregas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tareas as $tarea)
        <tr>
            <td><strong>{{ $tarea->titulo }}</strong></td>
            <td>{{ $tarea->grupo->nombre ?? '—' }}</td>
            <td>{{ $tarea->fecha_entrega->format('d/m/Y') }}</td>
            <td>
                <span class="badge badge-blue">
                    {{ $tarea->entregas->count() }} entrega(s)
                </span>
            </td>
            <td>
                <a href="/tareas/{{ $tarea->id }}/entregas?maestro_id={{ $maestro->id }}"
                   class="btn btn-sm btn-success">
                    Ver entregas
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
