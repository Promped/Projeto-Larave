<aside class="flex flex-col w-full md:w-72 bg-[#0046AD] min-h-screen text-white shadow-2xl">
    <div class="p-6">
        <h3 class="text-xl font-black mb-8 border-b border-white/10 pb-4 tracking-tighter italic">
            Logistics<span class="text-[#00A859]">Pro</span>
        </h3> 
        
        <nav class="flex flex-col gap-1 overflow-y-auto max-h-[calc(100vh-120px)] pr-2 custom-scroll">
            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}" 
                class="px-4 py-3 rounded-xl transition-all flex items-center group {{ request()->routeIs('admin.dashboard') || request()->routeIs('inicial-adm') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'hover:bg-white/10 text-blue-100' }}">
                <span class="mr-3 text-lg">📊</span> Painel Geral
            </a>

            @php
                // Helper para verificar se o usuário logado é Master/Admin de forma segura
                $isMaster = auth()->check() && (strtolower(trim(auth()->user()->role)) === 'master' || strtolower(trim(auth()->user()->role)) === 'admin');
            @endphp

            {{-- CONTROLE EXCLUSIVO MASTER: USUÁRIOS DO SISTEMA --}}
            @if($isMaster)
                <div class="mt-8 mb-2 px-4 text-[10px] font-black text-amber-300 uppercase tracking-[0.2em]">
                    Segurança Central
                </div>
                <a href="{{ route('usuarios.index') }}" 
                    class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('usuarios.*') ? 'bg-amber-500 shadow-lg font-bold text-white' : 'text-amber-100 hover:bg-white/10' }}">
                    <span class="mr-3 text-base">🔑</span> Gerenciar Usuários
                </a>
            @endif

            {{-- OPERAÇÃO DE PÁTIO --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Operação de Pátio 
            </div>

            {{-- AGENDAMENTOS: SOMENTE MASTER VE --}}
            @if($isMaster)
                <a href="{{ route('agendamentos.index') }}" 
                    class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('agendamentos.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                    <span class="mr-3 text-base">📅</span> Agendamentos
                </a>
            @endif

            {{-- ENTRADAS / SAÍDAS: OPERADOR TAMBÉM VÊ --}}
            <a href="{{ route('movimentacoes.index') }}" 
                class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('movimentacoes.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">🚛</span>  Entradas / Saídas
            </a>

            {{-- OCORRÊNCIAS: OPERADOR TAMBÉM VÊ --}}
            <a href="{{ route('patio.ocorrencia') }}" 
                class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('patio.ocorrencia') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">⚠️</span>   Ocorrências
            </a>

            {{-- LIBERAÇÃO FINAL: SOMENTE MASTER VE --}}
            @if($isMaster)
                <a href="{{ route('liberacao.index') }}" 
                    class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('liberacao.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                    <span class="mr-3 text-base">✅</span>   Liberação Final
                </a>
            @endif

            {{-- ESTOQUE & PRODUÇÃO --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Estoque & Produção
            </div>
            
            {{-- ESTOQUE ATUAL: OPERADOR TAMBÉM VÊ --}}
            <a href="{{ route('estoque.index') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('estoque.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📦</span>   Estoque Atual
            </a>

            {{-- MONTAGEM DE PRODUTOS: SOMENTE MASTER VE --}}
            @if($isMaster)
                <a href="{{ route('cargas.montar') }}" 
                   class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('cargas.montar') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                    <span class="mr-3 text-base">🛠️</span>   Montar Produto
                </a>
            @endif

            {{-- CADASTROS BASE --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Cadastros Base
            </div>
            @php
                // Montamos a lista de cadastros aplicando o filtro dinâmico
                // Removido da lista: Funções, Áreas e Vagas para o operador (Somente o Master verá estes)
                $cadastros = [
                    ['r' => 'transportadoras.index', 'i' => '🏢', 'l' => ' Fornecedores', 'masterOnly' => false],
                    ['r' => 'veiculos.index', 'i' => '🚚', 'l' => 'Veículos', 'masterOnly' => false],
                    ['r' => 'motoristas.index', 'i' => '👨‍✈️', 'l' => ' Motoristas', 'masterOnly' => false],
                    ['r' => 'cargas.index', 'i' => '📦', 'l' => ' Cargas', 'masterOnly' => false],
                    ['r' => 'funcaovisitantes.index', 'i' => '🛂', 'l' => 'Funções', 'masterOnly' => true],
                    ['r' => 'areaspatio.index', 'i' => '📍', 'l' => ' Áreas', 'masterOnly' => true],
                    ['r' => 'vagas.index', 'i' => '🅿️', 'l' => ' Vagas', 'masterOnly' => true],
                ];
            @endphp
            @foreach($cadastros as $c)
                {{-- Só renderiza se não for restrito ao master, OU se for restrito mas o usuário for Master --}}
                @if(!$c['masterOnly'] || $isMaster)
                    <a href="{{ route($c['r']) }}" 
                       class="px-4 py-2 rounded-lg text-[13px] flex items-center transition-all {{ request()->routeIs($c['r'].'*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                        <span class="mr-3 text-base">{{ $c['i'] }}</span> {{ $c['l'] }}
                    </a>
                @endif
            @endforeach

            {{-- RELATÓRIOS --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Relatórios & Saída
            </div>
            
            {{-- RELATÓRIO GERENCIAL: SOMENTE MASTER VE --}}
            @if($isMaster)
                <a href="{{ route('relatorios.gerencial') }}" 
                   class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('relatorios.gerencial') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                    <span class="mr-3 text-base">📈</span>   Gerencial
                </a>
            @endif
            
            {{-- HISTÓRICO: OPERADOR TAMBÉM VÊ --}}
            <a href="{{ route('relatorios.historico') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('relatorios.historico') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📜</span> Histórico
            </a>

            @if($isMaster)
                <a href="{{ route('relatorios.gerencial') }}" 
                    class="mt-6 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs flex items-center font-bold hover:bg-red-600 hover:text-white transition-all animate-pulse">
                    <span class="mr-2 text-base">🚨</span>   Alerta de Estoque
                </a>
            @endif
        </nav>
    </div>
</aside>