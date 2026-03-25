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
use App\Http\Controllers\GerenciamentoPatioController;
use App\Http\Controllers\CargaController;
use App\Http\Controllers\VagasPatioController; 
use App\Http\Controllers\AgendamentoController;

// Rota inicial
Route::get('/', function () {
    return redirect()->to('/inicial');
});

// Rotas públicas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showFormCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastrarUsuario']);

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function () {

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

        // --- CADASTROS BASE ---
        // RESTAURADO: Mantendo o nome original para não quebrar o formulário pronto
        Route::resource('funcaovisitantes', FuncaoVisitanteController::class); 
        
        Route::resource('transportadoras', TransportadoraController::class);
        Route::resource('motoristas', MotoristasController::class);
        Route::resource('cargas', CargaController::class);
        Route::resource('areaspatio', AreaspatioController::class);
        Route::resource('vagas', VagasPatioController::class);

        // --- OPERAÇÃO DE PÁTIO (FUNÇÕES FUNDAMENTAIS) ---
Route::prefix('patio')->group(function () {
    
    // F_F01: Aqui entra o controller novo que fizemos
    Route::resource('agendamentos', AgendamentoController::class);

    // F_F03: Suas rotas de Entrada/Saída que já existiam
    Route::get('/entrada', [GerenciamentoPatioController::class, 'indexEntrada'])->name('patio.entrada');
    Route::post('/entrada', [GerenciamentoPatioController::class, 'storeEntrada'])->name('patio.entrada.store');
    
    Route::get('/saida', [GerenciamentoPatioController::class, 'indexSaida'])->name('patio.saida');
    Route::post('/saida/{id}', [GerenciamentoPatioController::class, 'registrarSaida'])->name('patio.saida.store');

    // F_F04: Sua rota de Ocorrência
    Route::get('/ocorrencia', [GerenciamentoPatioController::class, 'indexOcorrencia'])->name('patio.ocorrencia');
    Route::post('/ocorrencia', [GerenciamentoPatioController::class, 'storeOcorrencia'])->name('patio.ocorrencia.store');
});
    });

    // Área do cliente
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });
});