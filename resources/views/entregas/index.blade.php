@extends('layout')
@section('content')

<h2>📚 Mis Tareas — {{ $alumno->nombre }}</h2>

@if($tareas->isEmpty())
    <div class="card" style="text-align:center;color:#718096;padding:40px;">
        No tienes tareas asignadas.
    </div>
@else
<table>
    <thead>
        <tr>
            <th>Tarea</th>
            <th>Grupo</th>
            <th>Fecha límite</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tareas as $tarea)
        @php $entrega = $tarea->entregas->first(); @endphp
        <tr>
            <td>
                <strong>{{ $tarea->titulo }}</strong>
                @if($tarea->descripcion)
                    <br>
                    <span style="color:#718096;font-size:12px;">
                        {{ Str::limit($tarea->descripcion, 60) }}
                    </span>
                @endif
            </td>
            <td>{{ $tarea->grupo->nombre }}</td>
            <td>
                {{ $tarea->fecha_entrega->format('d/m/Y') }}
                @if($tarea->fecha_entrega->isPast() && !$entrega)
                    <br><span style="color:#e53e3e;font-size:11px;">⚠ Vencida</span>
                @endif
            </td>
            <td>
                @if($entrega)
                    @if($entrega->estado === 'revisado')
                        <span class="badge badge-green">✔ Revisada</span>
                    @else
                        <span class="badge badge-blue">📤 Entregada</span>
                    @endif
                @else
                    <span class="badge badge-gray">Pendiente</span>
                @endif
            </td>
            <td>
                @if(!$entrega)
                    <a href="/entregas/tarea/{{ $tarea->id }}/crear?alumno_id={{ $alumno->id }}"
                       class="btn btn-sm btn-primary">Entregar PDF</a>
                @else
                    <a href="/entregas/{{ $entrega->id }}/pdf" target="_blank"
                       class="btn btn-sm" style="background:#e2e8f0;color:#4a5568;">
                        Ver mi PDF
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection
