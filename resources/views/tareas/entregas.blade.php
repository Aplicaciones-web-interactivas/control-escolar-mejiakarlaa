@extends('layout')
@section('content')

<div style="margin-bottom:16px;">
    <a href="/tareas?maestro_id={{ $tarea->maestro_id }}"
       style="color:#4299e1;font-size:14px;">← Volver a mis tareas</a>
</div>

<div class="card" style="margin-bottom:20px;">
    <h2>📎 Entregas: {{ $tarea->titulo }}</h2>
    <p style="color:#718096;margin:0;">
        Grupo: <strong>{{ $tarea->grupo->nombre }}</strong> &nbsp;·&nbsp;
        Fecha límite: <strong>{{ $tarea->fecha_entrega->format('d/m/Y') }}</strong>
    </p>
    @if($tarea->descripcion)
        <p style="margin-top:10px;font-size:14px;">{{ $tarea->descripcion }}</p>
    @endif
</div>

@if($tarea->entregas->isEmpty())
    <div class="card" style="text-align:center;color:#718096;padding:40px;">
        Ningún alumno ha entregado esta tarea aún.
    </div>
@else
<table>
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Fecha de entrega</th>
            <th>Comentario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarea->entregas as $entrega)
        <tr>
            <td>{{ $entrega->alumno->nombre }}</td>
            <td>{{ $entrega->created_at->format('d/m/Y H:i') }}</td>
            <td style="color:#718096;font-size:13px;">{{ $entrega->comentario ?? '—' }}</td>
            <td>
                @if($entrega->estado === 'revisado')
                    <span class="badge badge-green">✔ Revisado</span>
                @else
                    <span class="badge badge-gray">Entregado</span>
                @endif
            </td>
            <td style="display:flex;gap:6px;flex-wrap:wrap;">
                <a href="/entregas/{{ $entrega->id }}/pdf" target="_blank"
                   class="btn btn-sm btn-primary">Ver PDF</a>

                @if($entrega->estado !== 'revisado')
                <form method="POST" action="/entregas/{{ $entrega->id }}/revisar">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">
                        Marcar revisada
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
