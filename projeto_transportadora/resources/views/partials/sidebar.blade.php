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

            {{-- OPERAÇÃO DE PÁTIO --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Operação de Pátio 
            </div>

            {{-- F_F01 --}}
            <a href="{{ route('agendamentos.index') }}" 
                class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('agendamentos.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📅</span> F_F01: Agendamentos
            </a>

            {{-- F_F03 --}}
            <a href="{{ route('movimentacoes.index') }}" 
                class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('movimentacoes.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">🚛</span> F_F03: Entradas / Saídas
            </a>

            {{-- F_F04: OCORRÊNCIAS (Apontando para a função do RelatorioController corrigida) --}}
            <a href="{{ route('patio.ocorrencia') }}" 
                class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('patio.ocorrencia') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">⚠️</span> F_F04: Ocorrências
            </a>

            {{-- F_F05 --}}
            <a href="javascript:void(0)" onclick="aviso('F_F05')" class="px-4 py-2.5 rounded-lg text-sm flex items-center text-white/40 hover:bg-white/5 italic">
                <span class="mr-3 text-base opacity-40">✅</span> F_F05: Liberação
            </a>

            {{-- PRODUÇÃO & ESTOQUE --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Produção & Estoque
            </div>
            
            <a href="{{ route('estoque.index') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('estoque.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📦</span> F_F08: Estoque
            </a>

            <a href="{{ route('producao.index') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('producao.*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">🛠️</span> F_F09: Produção
            </a>

            {{-- CADASTROS BASE --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Cadastros Base
            </div>
            @php
                $cadastros = [
                    ['r' => 'transportadoras.index', 'i' => '🏢', 'l' => 'F_B04: Fornecedores'],
                    ['r' => 'veiculos.index', 'i' => '🚚', 'l' => 'F_B01: Veículos'],
                    ['r' => 'motoristas.index', 'i' => '👨‍✈️', 'l' => 'F_B02: Motoristas'],
                    ['r' => 'cargas.index', 'i' => '📦', 'l' => 'F_B03: Cargas'],
                    ['r' => 'funcaovisitantes.index', 'i' => '🛂', 'l' => 'F_B06: Funções'],
                    ['r' => 'areaspatio.index', 'i' => '📍', 'l' => 'F_B07: Áreas'],
                    ['r' => 'vagas.index', 'i' => '🅿️', 'l' => 'F_B08: Vagas'],
                ];
            @endphp
            @foreach($cadastros as $c)
                <a href="{{ route($c['r']) }}" 
                   class="px-4 py-2 rounded-lg text-[13px] flex items-center transition-all {{ request()->routeIs($c['r'].'*') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100/70 hover:bg-white/10 hover:text-white' }}">
                    <span class="mr-3 text-base">{{ $c['i'] }}</span> {{ $c['l'] }}
                </a>
            @endforeach

            {{-- RELATÓRIOS --}}
            <div class="mt-8 mb-2 px-4 text-[10px] font-black text-blue-300/50 uppercase tracking-[0.2em]">
                Relatórios & Saída
            </div>
            
            <a href="{{ route('relatorios.gerencial') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('relatorios.gerencial') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📈</span> F_S01: Gerencial
            </a>
            
            <a href="{{ route('relatorios.historico') }}" 
               class="px-4 py-2.5 rounded-lg text-sm flex items-center transition-all {{ request()->routeIs('relatorios.historico') ? 'bg-[#00A859] shadow-lg font-bold text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <span class="mr-3 text-base">📜</span> F_S02: Histórico
            </a>

            <a href="{{ route('relatorios.gerencial') }}" 
                class="mt-6 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-xs flex items-center font-bold hover:bg-red-600 hover:text-white transition-all animate-pulse">
                <span class="mr-2 text-base">🚨</span> F_S04: Alerta de Estoque
            </a>
        </nav>
    </div>
</aside>

<script>
    function aviso(modulo) {
        alert("O módulo " + modulo + " ainda está sendo finalizado. Em breve estará disponível!");
    }
</script>

<style>
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
</style>