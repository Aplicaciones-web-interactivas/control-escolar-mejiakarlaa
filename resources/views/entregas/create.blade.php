@extends('layout')
@section('content')

<div style="margin-bottom:16px;">
    <a href="/entregas?alumno_id={{ $alumno->id }}"
       style="color:#4299e1;font-size:14px;">← Volver a mis tareas</a>
</div>

<div class="card" style="max-width:520px;margin:0 auto;">
    <h2>📤 Entregar Tarea</h2>

    <div style="background:#ebf8ff;border:1px solid #bee3f8;border-radius:6px;
                padding:12px 16px;margin-bottom:20px;">
        <strong>{{ $tarea->titulo }}</strong><br>
        <span style="font-size:13px;color:#4a5568;">
            Grupo: {{ $tarea->grupo->nombre }} &nbsp;·&nbsp;
            Fecha límite: {{ $tarea->fecha_entrega->format('d/m/Y') }}
        </span>
        @if($tarea->descripcion)
            <p style="margin:8px 0 0;font-size:13px;">{{ $tarea->descripcion }}</p>
        @endif
    </div>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="/entregas/tarea/{{ $tarea->id }}"
          enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="alumno_id" value="{{ $alumno->id }}">

        <label>Archivo PDF * (máximo 5 MB)</label>
        <input type="file" name="archivo_pdf" accept=".pdf" required
               style="padding:6px;border:1px solid #cbd5e0;border-radius:5px;
                      width:100%;box-sizing:border-box;margin-bottom:14px;">

        <label>Comentario (opcional)</label>
        <textarea name="comentario" rows="3"
                  placeholder="Agrega algún comentario...">{{ old('comentario') }}</textarea>

        <button type="submit" class="btn btn-primary">Subir entrega</button>
        <a href="/entregas?alumno_id={{ $alumno->id }}"
           class="btn" style="background:#e2e8f0;color:#4a5568;margin-left:8px;">
            Cancelar
        </a>
    </form>
</div>

@endsection
