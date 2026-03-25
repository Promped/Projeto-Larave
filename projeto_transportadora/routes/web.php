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
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ProducaoController;
use App\Http\Controllers\EstoqueController;

// Rota inicial
Route::get('/', function () {
    return redirect()->to('/inicial');
});

// Rotas públicas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showFormCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastrarUsuario']); // Corrigido: Route:: adicionado

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
        
        // DASHBOARD: Agora aponta para o CargaController@index para carregar os dados de ocupação
        Route::get('/inicial-adm', [CargaController::class, 'index'])->name('inicial-adm');
        Route::get('/meu-painel', [CargaController::class, 'index'])->name('admin.dashboard');

        // --- CADASTROS BASE (F_B) ---
        Route::resource('funcaovisitantes', FuncaoVisitanteController::class); 
        Route::resource('transportadoras', TransportadoraController::class);
        Route::resource('motoristas', MotoristasController::class);
        Route::resource('cargas', CargaController::class); // F_B03
        Route::resource('areaspatio', AreaspatioController::class); // F_B07
        Route::resource('vagas', VagasPatioController::class); // F_B08

        // --- OPERAÇÃO DE PÁTIO (F_F) ---
        Route::prefix('patio')->group(function () {
            Route::resource('agendamentos', AgendamentoController::class);

            // F_F03: Entrada/Saída
            Route::get('/entrada', [GerenciamentoPatioController::class, 'indexEntrada'])->name('patio.entrada');
            Route::post('/entrada', [GerenciamentoPatioController::class, 'storeEntrada'])->name('patio.entrada.store');
            Route::get('/saida', [GerenciamentoPatioController::class, 'indexSaida'])->name('patio.saida');
            Route::post('/saida/{id}', [GerenciamentoPatioController::class, 'registrarSaida'])->name('patio.saida.store');

            // F_F04: Ocorrências
            Route::get('/ocorrencia', [GerenciamentoPatioController::class, 'indexOcorrencia'])->name('patio.ocorrencia');
            Route::post('/ocorrencia', [GerenciamentoPatioController::class, 'storeOcorrencia'])->name('patio.ocorrencia.store');
        });

        // --- PRODUÇÃO & ESTOQUE (F_F) ---
        Route::resource('estoque', EstoqueController::class); 
        Route::resource('producao', ProducaoController::class); 
        Route::post('/producao/baixar', [ProducaoController::class, 'baixarEstoque'])->name('producao.baixar');

        // --- RELATÓRIOS E SAÍDAS (F_S) ---
        Route::prefix('relatorios')->group(function () {
            Route::get('/gerencial', [RelatorioController::class, 'gerencial'])->name('relatorios.gerencial'); 
            Route::get('/historico', [RelatorioController::class, 'historico'])->name('relatorios.historico'); 
            Route::get('/compras', [RelatorioController::class, 'compras'])->name('relatorios.compras');     
        });

    });

    // Área do cliente
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });
});