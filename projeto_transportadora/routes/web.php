<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncaoVisitanteController;
use App\Http\Controllers\TransportadoraController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('funcaovisitante', FuncaoVisitanteController::class);




Route::resource('transportadora', TransportadoraController::class);


Route::resource('motorista', MotoristaController::class);

Route::resource('areaspatio', AreaspatioController::class);
