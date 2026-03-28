<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EntregaController;

Route::get('/', fn() => redirect('/inscripciones'));

// Inscripciones
Route::get('/inscripciones',        [InscripcionController::class, 'index']);
Route::get('/inscripciones/create', [InscripcionController::class, 'create']);
Route::post('/inscripciones/store', [InscripcionController::class, 'store']);

// Calificaciones
Route::get('/calificaciones',        [CalificacionController::class, 'index']);
Route::get('/calificaciones/create', [CalificacionController::class, 'create']);
Route::post('/calificaciones/store', [CalificacionController::class, 'store']);

// Tareas (maestro)
Route::get('/tareas',                  [TareaController::class, 'index']);
Route::get('/tareas/create',           [TareaController::class, 'create']);
Route::post('/tareas',                 [TareaController::class, 'store']);
Route::get('/tareas/{tarea}/entregas', [TareaController::class, 'verEntregas']);

// Entregas (alumno)
Route::get('/entregas',                        [EntregaController::class, 'index']);
Route::get('/entregas/tarea/{tarea}/crear',    [EntregaController::class, 'create']);
Route::post('/entregas/tarea/{tarea}',         [EntregaController::class, 'store']);
Route::get('/entregas/{entrega}/pdf',          [EntregaController::class, 'verPdf']);
Route::post('/entregas/{entrega}/revisar',     [EntregaController::class, 'marcarRevisada']);
