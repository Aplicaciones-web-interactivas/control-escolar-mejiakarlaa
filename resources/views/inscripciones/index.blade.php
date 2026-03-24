@extends('layout')
@section('content')

<h2>Inscripciones</h2>

<a href="/inscripciones/create">Nueva</a>

<table border="1">
<tr>
    <th>Alumno</th>
    <th>Grupo</th>
    <th>Fecha</th>
</tr>

@foreach($inscripciones as $i)
<tr>
    <td>{{ $i->alumno->nombre }}</td>
    <td>{{ $i->grupo->nombre }}</td>
    <td>{{ $i->fecha_inscripcion }}</td>
</tr>
@endforeach

</table>

@endsection