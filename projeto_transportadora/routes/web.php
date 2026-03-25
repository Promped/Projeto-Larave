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
use App\Http\Controllers\RelatorioController; // NOVO: Para as F_Ss

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

    // Área do administrador (TUDO DO PÁTIO FICA AQUI)
    Route::middleware([NivelAdmMiddleware::class])->group(function () {
        Route::resource('veiculos', VeiculoController::class);
        Route::resource('clientes', ClienteController::class);
        
        Route::get('/inicial-adm', function () {
            return view('inicial-adm');
        })->name('inicial-adm');
        
        Route::get('/meu-painel', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // --- CADASTROS BASE (F_B) ---
        Route::resource('funcaovisitantes', FuncaoVisitanteController::class); 
        Route::resource('transportadoras', TransportadoraController::class);
        Route::resource('motoristas', MotoristasController::class);
        Route::resource('cargas', CargaController::class);
        Route::resource('areaspatio', AreaspatioController::class);
        Route::resource('vagas', VagasPatioController::class);

        // --- OPERAÇÃO DE PÁTIO (F_F) ---
        Route::prefix('patio')->group(function () {
            // F_F01: Agendamentos
            Route::resource('agendamentos', AgendamentoController::class);

            // F_F03: Entrada/Saída
            Route::get('/entrada', [GerenciamentoPatioController::class, 'indexEntrada'])->name('patio.entrada');
            Route::post('/entrada', [GerenciamentoPatioController::class, 'storeEntrada'])->name('patio.entrada.store');
            Route::get('/saida', [GerenciamentoPatioController::class, 'indexSaida'])->name('patio.saida');
            Route::post('/saida/{id}', [GerenciamentoPatioController::class, 'registrarSaida'])->name('patio.saida.store');

            // F_F04: Ocorrências
            Route::get('/ocorrencia', [GerenciamentoPatioController::class, 'indexOcorrencia'])->name('patio.ocorrencia');
            Route::post('/ocorrencia', [GerenciamentoPatioController::class, 'storeOcorrencia'])->name('patio.ocorrencia.store');

            // F_F08 e F_F09: Estoque e Produção (Rotas de exemplo para não dar erro na sidebar)
            Route::get('/estoque', function() { return view('estoque.index'); })->name('estoque.index');
            Route::get('/producao', function() { return view('producao.index'); })->name('producao.index');
        });

        // --- RELATÓRIOS E SAÍDAS (F_S) ---
        Route::prefix('relatorios')->group(function () {
            Route::get('/gerencial', [RelatorioController::class, 'gerencial'])->name('relatorios.gerencial'); // F_S01
            Route::get('/historico', [RelatorioController::class, 'historico'])->name('relatorios.historico'); // F_S02
            Route::get('/compras', [RelatorioController::class, 'compras'])->name('relatorios.compras');     // F_S03
        });

    });

    // Área do cliente
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });
});