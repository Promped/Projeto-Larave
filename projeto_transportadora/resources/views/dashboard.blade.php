@extends('layout')

@section('content')
<div class="p-8 bg-white min-h-screen">
    <header class="flex justify-between items-end mb-10">
        <div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1">Visão Geral</p>
            <h1 class="text-3xl font-black text-slate-800 tracking-tighter">Painel de Controle</h1>
        </div>
        <div class="text-right">
            <p class="text-xs font-bold text-slate-400">{{ date('d \d\e F, Y') }}</p>
        </div>
    </header>

    {{-- Cards Principais --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-[#0046AD] transition-all cursor-default">
            <div>
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-1">Veículos em Pátio</p>
                <h2 class="text-4xl font-black text-slate-800 tracking-tighter">{{ $stats['total_veiculos'] }}</h2>
            </div>
            <div class="h-14 w-14 bg-blue-50 text-[#0046AD] rounded-2xl flex items-center justify-center text-2xl">🚛</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-[#00A859] transition-all cursor-default">
            <div>
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-1">Motoristas Ativos</p>
                <h2 class="text-4xl font-black text-slate-800 tracking-tighter">{{ $stats['total_motoristas'] }}</h2>
            </div>
            <div class="h-14 w-14 bg-green-50 text-[#00A859] rounded-2xl flex items-center justify-center text-2xl">👨‍✈️</div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group hover:border-[#0046AD] transition-all cursor-default">
            <div>
                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest mb-1">Parceiros Logísticos</p>
                <h2 class="text-4xl font-black text-slate-800 tracking-tighter">{{ $stats['total_transportadoras'] }}</h2>
            </div>
            <div class="h-14 w-14 bg-blue-50 text-[#0046AD] rounded-2xl flex items-center justify-center text-2xl">🏢</div>
        </div>
    </div>

    {{-- Gráficos --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
            <h3 class="font-black text-slate-700 mb-8 uppercase text-xs tracking-widest flex items-center gap-2">
                <span class="w-2 h-2 bg-[#0046AD] rounded-full"></span> Volume por Insumo
            </h3>
            <canvas id="estoqueChart" height="220"></canvas>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 text-center relative">
            <h3 class="font-black text-slate-700 mb-8 uppercase text-xs tracking-widest">Ocupação do Pátio</h3>
            <div class="relative" style="height: 250px;">
                <canvas id="pizzaChart"></canvas>
                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                    <span class="text-5xl font-black text-slate-800 tracking-tighter">{{ number_format($percentual, 1) }}%</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Capacidade</span>
                </div>
            </div>
            <div class="mt-8">
                @if($percentual >= 90)
                    <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-red-50 text-red-600 border border-red-100">
                        <span class="w-2 h-2 bg-red-600 rounded-full animate-ping"></span>
                        <span class="text-xs font-black uppercase tracking-widest">Estado Crítico</span>
                    </div>
                @elseif($percentual >= 70)
                    <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-yellow-50 text-yellow-600 border border-yellow-100">
                        <span class="w-2 h-2 bg-yellow-600 rounded-full"></span>
                        <span class="text-xs font-black uppercase tracking-widest">Atenção Necessária</span>
                    </div>
                @else
                    <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-green-50 text-green-600 border border-green-100">
                        <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                        <span class="text-xs font-black uppercase tracking-widest">Operação Normal</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Cores Suzano e Alertas
    const percentValue = {{ $percentual }};
    const corGrafico = percentValue >= 90 ? '#ef4444' : (percentValue >= 70 ? '#f59e0b' : '#00A859');

    // Chart Donut
    new Chart(document.getElementById('pizzaChart'), {
        type: 'doughnut',
        data: {
            labels: ['Ocupado', 'Livre'],
            datasets: [{
                data: {!! json_encode($dadosPizza) !!},
                backgroundColor: [corGrafico, '#f1f5f9'],
                hoverOffset: 0,
                borderWidth: 0
            }]
        },
        options: {
            cutout: '82%',
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    // Chart Barras
    new Chart(document.getElementById('estoqueChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                data: {!! json_encode($valores) !!},
                backgroundColor: '#0046AD',
                borderRadius: 8,
                barThickness: 32
            }]
        },
        options: {
            scales: {
                y: { grid: { display: false }, ticks: { font: { size: 10, weight: 'bold' } } },
                x: { grid: { display: false }, ticks: { font: { size: 10, weight: 'bold' } } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection