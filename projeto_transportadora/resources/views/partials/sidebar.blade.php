<aside class="w-full md:w-64 bg-white shadow-md min-h-screen overflow-y-auto border-r">
    <div class="p-4">
        <h3 class="text-lg font-bold mb-4 border-b pb-2 text-blue-800">Sistema Logístico</h3>
        
        <nav class="flex flex-col gap-1">
            <a href="{{ route('admin.dashboard') }}" 
               class="px-3 py-2 rounded hover:bg-blue-50 font-semibold flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-800' : 'text-blue-700' }}">
                <span class="mr-2">📊</span> Painel Geral
            </a>

            <div class="mt-4 mb-1 px-3 text-xs font-bold text-blue-500 uppercase tracking-wider">
                Operação de Pátio
            </div>
            <a href="{{ route('agendamentos.index') }}" 
               class="px-3 py-2 rounded hover:bg-green-50 text-gray-700 border-l-4 {{ request()->routeIs('agendamentos.*') ? 'border-green-500 bg-green-50 font-bold' : 'border-transparent' }} text-sm">
                📅 F_F01: Agendamentos
            </a>
            <a href="{{ route('patio.entrada') }}" 
               class="px-3 py-2 rounded hover:bg-green-50 text-gray-700 border-l-4 {{ request()->routeIs('patio.entrada*') ? 'border-green-500 bg-green-50 font-bold' : 'border-transparent' }} text-sm">
                🚛 F_F03: Entradas / Saídas
            </a>
            <a href="{{ route('patio.ocorrencia') }}" 
               class="px-3 py-2 rounded hover:bg-red-50 text-gray-700 border-l-4 {{ request()->routeIs('patio.ocorrencia*') ? 'border-red-500 bg-red-50 font-bold' : 'border-transparent' }} text-sm">
                ⚠️ F_F04: Ocorrências
            </a>
            <a href="{{ route('patio.saida') }}" 
               class="px-3 py-2 rounded hover:bg-blue-50 text-gray-700 border-l-4 {{ request()->routeIs('patio.saida*') ? 'border-blue-500 bg-blue-50 font-bold' : 'border-transparent' }} text-sm">
                ✅ F_F05: Liberação
            </a>

            <div class="mt-4 mb-1 px-3 text-xs font-bold text-orange-600 uppercase tracking-wider">
                Produção & Estoque
            </div>
            <a href="{{ route('estoque.index') }}" 
               class="px-3 py-2 rounded hover:bg-orange-50 text-gray-700 text-sm flex items-center {{ request()->routeIs('estoque.*') ? 'bg-orange-100 font-bold' : '' }}">
                <span class="mr-2">📦</span> F_F08: Estoque
            </a>
            <a href="{{ route('producao.index') }}" 
               class="px-3 py-2 rounded hover:bg-orange-50 text-gray-700 text-sm flex items-center {{ request()->routeIs('producao.*') ? 'bg-orange-100 font-bold' : '' }}">
                <span class="mr-2">🛠️</span> F_F09: Produção
            </a>

            <div class="mt-4 mb-1 px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">
                Cadastros Base
            </div>
            <a href="{{ route('transportadoras.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('transportadoras.*') ? 'bg-gray-200 font-bold' : '' }}">
                <span class="mr-2">🏢</span> F_B04: Fornecedores
            </a>
            <a href="{{ route('veiculos.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('veiculos.*') ? 'bg-gray-200 font-bold' : '' }}">
                <span class="mr-2">🚚</span> F_B01: Veículos
            </a>
            <a href="{{ route('motoristas.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('motoristas.*') ? 'bg-gray-200 font-bold' : '' }}">
                <span class="mr-2">👨‍✈️</span> F_B02: Motoristas
            </a>
            <a href="{{ route('cargas.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('cargas.*') ? 'bg-gray-200 font-bold text-blue-700' : '' }}">
                <span class="mr-2">📦</span> F_B03: Cargas
            </a>
            <a href="{{ route('funcaovisitantes.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('funcaovisitantes.*') ? 'bg-gray-200 font-bold' : '' }}">
                 <span class="mr-2">🛂</span> F_B06: Funções Visitantes
            </a>
            <a href="{{ route('areaspatio.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('areaspatio.*') ? 'bg-gray-200 font-bold text-blue-700' : '' }}">
                <span class="mr-2">📍</span> F_B07: Áreas
            </a>
            <a href="{{ route('vagas.index') }}" 
               class="px-3 py-1 rounded hover:bg-gray-100 text-gray-600 text-xs flex items-center {{ request()->routeIs('vagas.*') ? 'bg-gray-200 font-bold' : '' }}">
                <span class="mr-2">🅿️</span> F_B08: Gestão de Vagas
            </a>

            <div class="mt-4 mb-1 px-3 text-xs font-bold text-purple-600 uppercase tracking-wider">
                Relatórios & Saída
            </div>
            <a href="{{ route('relatorios.gerencial') }}" 
               class="px-3 py-2 rounded hover:bg-purple-50 text-purple-700 text-sm flex items-center {{ request()->routeIs('relatorios.gerencial') ? 'bg-purple-100 font-bold' : '' }}">
                <span class="mr-2">📈</span> F_S01: Relatórios Gerenciais
            </a>
            <a href="{{ route('relatorios.historico') }}" 
               class="px-3 py-2 rounded hover:bg-purple-50 text-purple-700 text-sm flex items-center {{ request()->routeIs('relatorios.historico') ? 'bg-purple-100 font-bold' : '' }}">
                <span class="mr-2">📜</span> F_S02: Histórico
            </a>
            <a href="{{ route('relatorios.compras') }}" 
               class="px-3 py-2 rounded hover:bg-purple-50 text-purple-700 text-sm flex items-center {{ request()->routeIs('relatorios.compras') ? 'bg-purple-100 font-bold' : '' }}">
                <span class="mr-2">🛒</span> F_S03: Compras MP
            </a>
            
            <a href="{{ route('relatorios.gerencial') }}" 
               class="px-3 py-2 rounded hover:bg-red-50 text-red-700 text-sm flex items-center font-bold border border-red-100 mt-2 animate-pulse">
                <span class="mr-2">🚨</span> F_S04: Alerta de Estoque
            </a>
        </nav>
    </div>
</aside>