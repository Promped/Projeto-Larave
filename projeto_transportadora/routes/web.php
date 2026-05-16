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
    LiberacaoController,
    TicketController,
    MovimentacaoPatioController,
    ComposicaoController, // Importado para a montagem de produtos (Kitting)
    UserController         // IMPORTADO PARA O GERENCIAMENTO DE USUÁRIOS
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

// Cadastro
Route::get('/cadastro', [AuthController::class, 'showFormCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'cadastrarUsuario']);

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/inicial', function () {
        return view('inicial');
    })->name('inicial');

    // Área do administrador (Nível 1)
    Route::middleware([NivelAdmMiddleware::class])->group(function () {
        
        // --- DASHBOARD ---
        Route::get('/inicial-adm', [CargaController::class, 'index'])->name('inicial-adm');
        Route::get('/meu-painel', [CargaController::class, 'index'])->name('admin.dashboard');

        // --- CONTROLE DE CREDENCIAIS / USUÁRIOS ---
        Route::resource('usuarios', UserController::class);

        // --- MONTAGEM DE PRODUTOS (KITTING) ---
        // Posicionado estrategicamente antes do resource de cargas para evitar conflito de URL
        Route::get('/cargas/montar', [ComposicaoController::class, 'create'])->name('cargas.montar');
        Route::post('/cargas/montar', [ComposicaoController::class, 'store'])->name('cargas.montar.store');

        // --- RECURSOS BÁSICOS (CADASTROS) ---
        Route::resource('veiculos', VeiculoController::class);
        Route::resource('clientes', ClienteController::class);
        Route::resource('funcaovisitantes', FuncaoVisitanteController::class); 
        Route::resource('transportadoras', TransportadoraController::class);
        Route::resource('motoristas', MotoristasController::class);
        Route::resource('cargas', CargaController::class);
        Route::resource('areaspatio', AreaspatioController::class);
        Route::resource('vagas', VagasPatioController::class);

        // --- OPERAÇÃO DE PÁTIO (F_F) ---
        Route::prefix('patio')->group(function () {
            Route::resource('agendamentos', AgendamentoController::class);
            Route::patch('movimentacoes/{id}/sair', [MovimentacaoPatioController::class, 'registrarSaida'])->name('movimentacoes.sair');
            Route::resource('movimentacoes', MovimentacaoPatioController::class);
            Route::post('/ocorrencia', [GerenciamentoPatioController::class, 'storeOcorrencia'])->name('patio.ocorrencia.store');
        });

        // --- F_F05: CONFERÊNCIA E LIBERAÇÃO ---
        Route::prefix('liberacao')->group(function () {
            Route::get('/pendentes', [LiberacaoController::class, 'index'])->name('liberacao.index');
            Route::get('/conferir/{id}', [LiberacaoController::class, 'show'])->name('liberacao.show');
            Route::post('/confirmar/{id}', [LiberacaoController::class, 'store'])->name('liberacao.store');
            Route::get('/comprovante/{id}', [LiberacaoController::class, 'comprovante'])->name('liberacao.comprovante');
        });
        
        // --- PRODUÇÃO & ESTOQUE ---
        Route::resource('estoque', EstoqueController::class); 
        Route::resource('producao', ProducaoController::class); 
        Route::post('/producao/baixar', [ProducaoController::class, 'baixarEstoque'])->name('producao.baixar');

        // --- RELATÓRIOS ---
        Route::prefix('relatorios')->group(function () {
            Route::get('/gerencial', [RelatorioController::class, 'gerencial'])->name('relatorios.gerencial'); 
            Route::get('/historico', [RelatorioController::class, 'historico'])->name('relatorios.historico'); 
            Route::get('/compras', [RelatorioController::class, 'compras'])->name('relatorios.compras');  
            Route::get('/ocorrencias', [RelatorioController::class, 'ocorrencias'])->name('patio.ocorrencia');
        });

        // --- TICKET DE SAÍDA ---
        Route::prefix('ticket')->group(function () {
            // Aceita GET e POST para não dar mais erro 405
            Route::match(['get', 'post'], '/gerar/{id}', [TicketController::class, 'buscar'])->name('ticket.gerar');
            
            // text/view validation 
            Route::get('/validar/{id}', [TicketController::class, 'validar'])->name('ticket.validar.view');
            Route::get('/buscar-cpf', [TicketController::class, 'buscar'])->name('ticket.buscar.cpf');
        });

    });

    // Área do cliente (Nível 2)
    Route::middleware([NivelCliMiddleware::class])->group(function () {
        Route::get('/inicial-cli', function () {
            return view('inicial-cli');
        })->name('inicial-cli');
    });
});