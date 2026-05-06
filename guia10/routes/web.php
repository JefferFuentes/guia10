<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CursoController;
Route::resource('cursos', CursoController::class); 

use App\Http\Controllers\AulaController;
Route::resource('aulas', AulaController::class); 