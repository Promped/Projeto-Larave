<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncaoVisitanteController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\MotoristasController;
use App\Http\Controllers\AreaspatioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Middleware\NivelAdmMiddleware;
use App\Http\Middleware\NivelCliMiddleware;
use App\Http\Controllers\VeiculoController;

// Rota inicial
Route::get('/', function () {
    return view('welcome');
});

// Rotas públicas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showFormCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastrarUsuario']);

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function () {

    // Logout e tela inicial comum
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/inicial', function () {
        return view('inicial');
    })->name('inicial');

    // Área do administrador
    Route::middleware([NivelAdmMiddleware::class])->group(function () {
        Route::resource('veiculos', VeiculoController::class);
        Route::resource('clientes', ClienteController::class);
        Route::get('/inicial-adm', function () {
            return view('inicial-adm');
        })->name('inicial-adm');
        
        Route::get('/meu-painel', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Área do cliente
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::resource('clientes', ClienteController::class);
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });

    // Outras rotas de recursos (também protegidas)
    Route::resource('funcaovisitantes', FuncaoVisitanteController::class);
    Route::resource('transportadoras', TransportadoraController::class);
    Route::resource('motoristas', MotoristasController::class);
    Route::resource('cargas', App\Http\Controllers\CargaController::class);
    Route::resource('areaspatio', AreaspatioController::class);
});
