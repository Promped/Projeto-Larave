@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    {{-- Cabeçalho Inteligente --}}
    <div class="mb-8 border-b border-slate-200 pb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Painel Geral de Operações</h1>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Status de ocupação e fluxo do pátio em tempo real</p>
            </div>
            
            {{-- Badge do escopo de visão --}}
            <div>
                @if(auth()->user()->role === 'master')
                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-black bg-purple-50 border border-purple-200 text-purple-700 uppercase tracking-wider">
                        ⚙️ Visão Global: Sistema Central
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-black bg-blue-50 border border-blue-200 text-blue-700 uppercase tracking-wider">
                        🏢 Visão Local: {{ auth()->user()->empresa }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Grid de Áreas com filtro Blade --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @php $temAreas = false; @endphp
        
        @foreach($areas as $area)
            {{-- REGRA DE CORTE SE FOR OPERADOR: Só exibe as áreas cuja empresa bate com a do operador --}}
            @if(auth()->user()->role === 'master' || (auth()->user()->role === 'operador' && Str::upper($area->empresa) === Str::upper(auth()->user()->empresa)))
                @php $temAreas = true; @endphp
                
                <div class="bg-white rounded-3xl shadow-xl border-t-4 {{ $area->ocupacao_percent >= 90 ? 'border-rose-500' : 'border-blue-600' }} p-6 transition-all hover:shadow-2xl">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">{{ $area->nome }}</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">
                                {{ $area->empresa ?? 'Pátio Geral' }}
                            </p>
                        </div>
                        <span class="px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $area->ocupacao_percent >= 90 ? 'bg-rose-50 border border-rose-200 text-rose-700' : 'bg-blue-50 border border-blue-200 text-blue-700' }}">
                            {{ number_format($area->ocupacao_percent, 0) }}% Ocupado
                        </span>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between text-xs font-bold uppercase tracking-tight">
                            <span class="text-slate-500">🚛 Veículos no Local:</span>
                            <span class="text-slate-800">{{ $area->veiculos_atual }} / {{ $area->vagas_totais }}</span>
                        </div>
                        
                        {{-- Barra de Progresso --}}
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden border border-slate-200/50">
                            <div class="h-full rounded-full transition-all duration-500 {{ $area->ocupacao_percent >= 90 ? 'bg-rose-500' : 'bg-blue-600' }}" 
                                 style="width: {{ $area->ocupacao_percent }}%"></div>
                        </div>
                        
                        <p class="text-[11px] font-black uppercase tracking-wide {{ $area->ocupacao_percent >= 90 ? 'text-rose-600 animate-pulse' : 'text-emerald-600' }}">
                            {{ $area->ocupacao_percent >= 90 ? '⚠️ Capacidade Crítica!' : '✅ Espaço Disponível' }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach

        {{-- Fallback caso a empresa não possua nenhuma área cadastrada --}}
        @if(!$temAreas)
            <div class="col-span-1 md:col-span-3 p-12 bg-white rounded-3xl border border-slate-200 text-center shadow-inner">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhuma área de pátio vinculada à sua empresa foi localizada.</p>
            </div>
        @endif
    </div>

    {{-- ESCONDER GRÁFICO INTEIRO OU PROTEGER DADOS --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-100">
        <div class="mb-4">
            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter">Fluxo de Entradas Mensais</h3>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                {{ auth()->user()->role === 'master' ? 'Métrica consolidada de todas as empresas' : 'Métrica de processamento de sua unidade local' }}
            </p>
        </div>
        <div class="relative w-full overflow-hidden" style="max-height: 250px;">
            <canvas id="meuGrafico" height="80"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    
    // Injeção dinâmica de dados dependendo de quem está logado
    const labelGrafico = "{{ auth()->user()->role === 'master' ? 'Total Sistema' : 'Sua Empresa' }}";
    const dadosFluxo = @json(auth()->user()->role === 'master' ? [45, 52, 80, 65, 95] : [12, 18, 30, 22, 35]);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
            datasets: [{
                label: labelGrafico,
                data: dadosFluxo,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.05)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#2563eb'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { 
                legend: { 
                    display: true,
                    labels: {
                        font: { size: 10, weight: 'bold' }
                    }
                } 
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9' },
                    ticks: { font: { size: 10, weight: 'bold' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: 'bold' } }
                }
            }
        }
    });
</script>
@endsection