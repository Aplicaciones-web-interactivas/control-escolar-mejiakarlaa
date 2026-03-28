@extends('layout')
@section('content')

<div class="card" style="max-width:560px; margin:0 auto;">
    <h2>➕ Nueva Tarea</h2>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="/tareas">
        @csrf
        <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">

        <label>Título *</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required>

        <label>Descripción</label>
        <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>

        <label>Grupo *</label>
        <select name="grupo_id" required>
            <option value="">— Selecciona un grupo —</option>
            @foreach($grupos as $g)
                <option value="{{ $g->id }}" {{ old('grupo_id') == $g->id ? 'selected' : '' }}>
                    {{ $g->nombre }}
                </option>
            @endforeach
        </select>

        <label>Fecha de entrega *</label>
        <input type="date" name="fecha_entrega" value="{{ old('fecha_entrega') }}" required>

        <button type="submit" class="btn btn-primary">Guardar tarea</button>
        <a href="/tareas?maestro_id={{ $maestro->id }}"
           class="btn" style="background:#e2e8f0;color:#4a5568;margin-left:8px;">
            Cancelar
        </a>
    </form>
</div>

@endsection
