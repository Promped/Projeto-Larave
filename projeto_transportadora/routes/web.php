<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FuncaoVisitanteController,
    TransportadoraController,
    MotoristasController,
    AreaspatioController,
    AuthController,
    ClienteController,
    VeiculoController,
    GerenciamentoPatioController,
    CargaController,
    VagasPatioController,
    AgendamentoController,
    RelatorioController,
    ProducaoController,
    EstoqueController,
    MovimentacaoPatioController
};
use App\Http\Middleware\NivelAdmMiddleware;
use App\Http\Middleware\NivelCliMiddleware;

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
        
        // DASHBOARD
        Route::get('/inicial-adm', [CargaController::class, 'index'])->name('inicial-adm');
        Route::get('/meu-painel', [CargaController::class, 'index'])->name('admin.dashboard');

        // --- CADASTROS BASE (F_B) ---
        Route::resource('funcaovisitantes', FuncaoVisitanteController::class); 
        Route::resource('transportadoras', TransportadoraController::class);
        Route::resource('motoristas', MotoristasController::class);
        Route::resource('cargas', CargaController::class);
        Route::resource('areaspatio', AreaspatioController::class);
        Route::resource('vagas', VagasPatioController::class);

        // --- OPERAÇÃO DE PÁTIO (F_F) ---
        Route::prefix('patio')->group(function () {
            Route::resource('agendamentos', AgendamentoController::class);

            // F_F03: Entrada/Saída
            Route::patch('movimentacoes/{id}/sair', [MovimentacaoPatioController::class, 'registrarSaida'])->name('movimentacoes.sair');
            Route::resource('movimentacoes', MovimentacaoPatioController::class);

            // F_F04: Ocorrências (APENAS O POST PARA SALVAR AQUI)
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

            // ESTA ROTA ABAIXO É A QUE ATENDE SIDEBAR E BOTÃO "VER DETALHES"
            Route::get('/ocorrencias', [RelatorioController::class, 'ocorrencias'])->name('patio.ocorrencia');
        });

    });

    // Área do cliente
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });
});