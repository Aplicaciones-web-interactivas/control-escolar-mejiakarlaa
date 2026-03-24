<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\InscripcionController;

Route::get('/', function () {
    return redirect('/inscripciones');
});

Route::get('/inscripciones',[InscripcionController::class,'index']);
Route::get('/inscripciones/create',[InscripcionController::class,'create']);
Route::post('/inscripciones/store',[InscripcionController::class,'store']);

Route::get('/inscripciones',[InscripcionController::class,'index']);
Route::get('/inscripciones/create',[InscripcionController::class,'create']);
Route::post('/inscripciones/store',[InscripcionController::class,'store']);

Route::get('/calificaciones',[CalificacionController::class,'index']);
Route::get('/calificaciones/create',[CalificacionController::class,'create']);
Route::post('/calificaciones/store',[CalificacionController::class,'store']);
