

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncaoVisitanteController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\AreaspatioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController; // Adicionei essa linha que estava faltando

Route::get('/', function () {
    return view('welcome');
});

// Rotas públicas de autenticação
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'ShowFormCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastrarUsuario']);

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function(){ // Corrigi "middlweware" para "middleware"
    Route::resource('cliente', ClienteController::class); // Corrigi "Router" para "Route"
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/inicial', function() { 
        return view("inicial");
    })->name('inicial');
});

// Outras rotas de recursos (proteja essas também se necessário)
Route::resource('funcaovisitantes', FuncaoVisitanteController::class);
Route::resource('transportadoras', TransportadoraController::class);
Route::resource('motoristas', MotoristasController::class);
Route::resource('areaspatio', AreaspatioController::class);
