<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\TecnicosController;
use App\Http\Controllers\CategoriasController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('chamados', ChamadosController::class);
Route::resource('tecnicos', TecnicosController::class);
Route::resource('categorias', CategoriasController::class);