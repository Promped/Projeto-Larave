<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncaoVisitanteController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\AreaspatioController;
use App\Http\Controllers\AuthController;

Route:: get('/login',[AuthController::class, 'showFormLogin'])->name('login'); 
Route::post('/login',[AuthController::class, 'login']);
Route::get('/cadastro',[AuthController::class, 'ShowFormCadastro']);
Route::post('/cadastro',[AuthController::class, 'cadastrarUsuario']);
Route ::middlweware('auth')->group(function(){
    Router::resource('cliente', ClienteController::class);
    Route::('/logout',[AuthController::class, 'logout']);
    Route::get('/inicial',function(){ return view("inicial");});

});
    

Route::get('/', function () {
    return view('welcome');
});

Route::resource('funcaovisitante', FuncaoVisitanteController::class);




Route::resource('transportadora', TransportadoraController::class);


Route::resource('motorista', MotoristaController::class);

Route::resource('areaspatio', AreaspatioController::class);
