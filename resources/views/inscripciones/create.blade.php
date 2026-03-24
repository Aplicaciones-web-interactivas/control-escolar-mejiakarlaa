<h2>Nueva Inscripción</h2>

<form method="POST" action="/inscripciones/store">
@csrf

<label>Alumno:</label>
<select name="usuario_id">
@foreach($alumnos as $a)
<option value="{{ $a->id }}">{{ $a->nombre }}</option>
@endforeach
</select>

<br><br>

<label>Grupo:</label>
<select name="grupo_id">
@foreach($grupos as $g)
<option value="{{ $g->id }}">{{ $g->nombre }}</option>
@endforeach
</select>

<br><br>

<label>Fecha:</label>
<input type="date" name="fecha_inscripcion">

<br><br>

<button type="submit">Guardar</button>

</form>