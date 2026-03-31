@extends('layout')

@section('content')
<div class="container mx-auto p-6 space-y-8 animate-fade-in">
    
    {{-- 1. HEADER ESTRATÉGICO --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-2 border-blue-100 pb-8 gap-4">
        <div>
            <h2 class="text-4xl font-black text-blue-900 uppercase tracking-tighter flex items-center gap-3">
                <span class="bg-blue-600 text-white p-3 rounded-2xl shadow-2xl rotate-3">📊</span>
                Painel Estratégico de Pátio
            </h2>
            <p class="text-xs text-gray-500 font-bold uppercase mt-2 tracking-widest flex items-center gap-2">
                <span class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></span>
                ID: F_S01 • Gestão de Fluxo em Tempo Real • {{ now()->format('d/m/Y') }}
            </p>
        </div>
        <div class="flex items-center gap-4 bg-white p-4 rounded-3xl shadow-xl border border-gray-100">
            <div class="text-right">
                <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1">Sincronização</p>
                <span class="text-blue-600 text-sm font-black italic tracking-tighter">{{ now()->format('H:i:s') }}</span>
            </div>
            <div class="h-10 w-[2px] bg-gray-100"></div>
            <div class="relative flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-600"></span>
            </div>
        </div>
    </div>

    {{-- 2. ALERTA CRÍTICO --}}
    @if($ocorrenciasCount > 0)
    <div class="bg-red-600 text-white p-5 rounded-3xl shadow-2xl flex justify-between items-center animate-bounce border-b-8 border-red-800">
        <div class="flex items-center gap-4">
            <span class="text-3xl">🚨</span>
            <div>
                <span class="font-black uppercase tracking-tighter text-lg block leading-none">Atenção Imediata</span>
                <span class="text-xs font-bold opacity-90 uppercase">Existem {{ $ocorrenciasCount }} ocorrências travando a operação do pátio!</span>
            </div>
        </div>
        <a href="/relatorios/ocorrencias" class="bg-white text-red-600 px-8 py-3 rounded-2xl font-black text-xs uppercase hover:scale-105 transition-all shadow-lg">
            Resolver Agora
        </a>
    </div>
    @endif

    {{-- 3. TICKETS DE INDICADORES (OS 4 CARDS) --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white border-b-8 border-blue-600 p-8 rounded-3xl shadow-xl hover:translate-y-[-8px] transition-all group">
            <p class="text-blue-600 font-black text-xs uppercase tracking-widest mb-2">Total Geral</p>
            <div class="flex justify-between items-end">
                <p class="text-5xl font-black text-slate-800 group-hover:scale-110 transition-transform">{{ $totalAgendamentos }}</p>
                <span class="text-slate-100 text-4xl font-black italic">AG</span>
            </div>
        </div>

        <div class="bg-white border-b-8 border-yellow-500 p-8 rounded-3xl shadow-xl hover:translate-y-[-8px] transition-all group">
            <p class="text-yellow-600 font-black text-xs uppercase tracking-widest mb-2">Em Fila (Check-in)</p>
            <div class="flex justify-between items-end">
                <p class="text-5xl font-black text-slate-800 group-hover:scale-110 transition-transform">{{ $pendentes }}</p>
                <span class="text-slate-100 text-4xl font-black italic">FL</span>
            </div>
        </div>

        <div class="bg-white border-b-8 border-green-500 p-8 rounded-3xl shadow-xl hover:translate-y-[-8px] transition-all group">
            <p class="text-green-600 font-black text-xs uppercase tracking-widest mb-2">Finalizados</p>
            <div class="flex justify-between items-end">
                <p class="text-5xl font-black text-slate-800 group-hover:scale-110 transition-transform">{{ $concluidos }}</p>
                <span class="text-slate-100 text-4xl font-black italic">OK</span>
            </div>
        </div>

        <div class="bg-white border-b-8 border-red-500 p-8 rounded-3xl shadow-xl hover:translate-y-[-8px] transition-all group">
            <p class="text-red-600 font-black text-xs uppercase tracking-widest mb-2">Ocorrências</p>
            <div class="flex justify-between items-end">
                <p class="text-5xl font-black text-red-600 group-hover:scale-110 transition-transform">{{ $ocorrenciasCount }}</p>
                <span class="text-red-50/50 text-4xl font-black italic">!!</span>
            </div>
        </div>
    </div>

    {{-- 4. GRID DE OPERAÇÃO --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        {{-- MÓDULO DE BUSCA DE TICKET (O QUE VOCÊ QUERIA) --}}
        <div class="bg-slate-900 shadow-2xl rounded-[2.5rem] p-8 border-t-8 border-blue-500 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <span class="text-9xl text-white font-black italic">PDF</span>
            </div>
            
            <div class="relative z-10">
                <h3 class="font-black text-white uppercase text-xl tracking-tighter mb-8 flex items-center gap-3">
                    <span class="bg-blue-600 p-2 rounded-lg text-2xl">🖨️</span> 
                    Emissão de Ticket de Entrada
                </h3>

                <form action="{{ route('ticket.buscar.cpf') }}" method="GET" class="space-y-6">
                    <div>
                        <label class="text-[10px] font-black text-blue-400 uppercase mb-3 block tracking-[0.2em]">Documento do Motorista (CPF)</label>
                        <div class="flex gap-3">
                            <input type="text" name="busca" required placeholder="000.000.000-00" 
                                class="flex-1 bg-slate-800 border-2 border-slate-700 rounded-2xl py-5 px-6 text-white text-xl font-bold placeholder-slate-600 focus:border-blue-500 transition-all outline-none shadow-inner">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-8 rounded-2xl font-black transition-all shadow-lg active:scale-95">
                                BUSCAR
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-8 grid grid-cols-2 gap-4">
                    <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700">
                        <p class="text-[9px] font-black text-gray-500 uppercase mb-1">Status do Módulo</p>
                        <p class="text-xs font-bold text-green-400 uppercase flex items-center gap-2">
                            <span class="h-2 w-2 bg-green-500 rounded-full"></span> Pronto para Emissão
                        </p>
                    </div>
                    <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700">
                        <p class="text-[9px] font-black text-gray-500 uppercase mb-1">Segurança</p>
                        <p class="text-xs font-bold text-blue-400 uppercase italic">Criptografia Ativa</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RANKING DE TRANSPORTADORAS --}}
        <div class="bg-white shadow-2xl rounded-[2.5rem] p-8 border-t-8 border-slate-800">
            <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
                <h3 class="font-black text-slate-800 uppercase text-lg tracking-tighter">Volume por Transportadora</h3>
                <span class="bg-slate-100 text-slate-500 text-[10px] font-black px-4 py-2 rounded-full uppercase">Top Performance</span>
            </div>
            <div class="space-y-4">
                @forelse($rankingTransportadoras as $index => $transp)
                <div class="flex items-center justify-between p-4 hover:bg-slate-50 rounded-2xl transition-all border border-transparent hover:border-slate-100">
                    <div class="flex items-center gap-4">
                        <span class="text-lg font-black text-slate-300 italic">{{ $index + 1 }}º</span>
                        <div>
                            <p class="font-black text-slate-800 uppercase text-sm leading-none">{{ $transp->empresa }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Parceiro Homologado</p>
                        </div>
                    </div>
                    <span class="bg-slate-900 text-white px-4 py-2 rounded-xl font-black text-sm shadow-md">
                        {{ $transp->total_viagens }} <small class="text-[9px] opacity-60">VIAGENS</small>
                    </span>
                </div>
                @empty
                <p class="text-center py-10 text-gray-400 font-bold uppercase italic text-xs">Nenhum dado processado hoje.</p>
                @endforelse
            </div>
        </div>

        {{-- ACESSOS RECENTES --}}
        <div class="bg-white shadow-2xl rounded-[2.5rem] p-8 border-t-8 border-purple-600">
            <h3 class="font-black text-purple-900 uppercase text-lg mb-8 tracking-tighter">Fluxo de Visitantes</h3>
            <div class="space-y-4">
                @foreach($ultimosVisitantes as $visitante)
                <div class="flex justify-between items-center p-5 bg-purple-50/50 rounded-3xl border border-purple-100/50">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 bg-purple-600 rounded-full flex items-center justify-center text-white font-black text-xs">
                            {{ substr($visitante->nome, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-800 uppercase leading-none">{{ $visitante->nome }}</p>
                            <p class="text-[9px] text-purple-500 font-bold uppercase mt-1">{{ $visitante->empresa }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="block text-xs font-black text-slate-800 leading-none">{{ $visitante->created_at->format('H:i') }}</span>
                        <span class="text-[9px] font-bold text-gray-400 uppercase">Horário Acesso</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- SATURAÇÃO DINÂMICA --}}
        <div class="bg-white shadow-2xl rounded-[2.5rem] p-8 border-t-8 border-orange-600">
            <h3 class="font-black text-orange-900 uppercase text-lg mb-8 tracking-tighter">Ocupação do Pátio</h3>
            <div class="flex items-center justify-center py-4">
                <div class="relative w-48 h-48">
                    <svg class="w-full h-full transform -rotate-90">
                        <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="20" fill="transparent" class="text-gray-100" />
                        <circle cx="96" cy="96" r="80" stroke="currentColor" stroke-width="20" fill="transparent" 
                            stroke-dasharray="502.6" 
                            stroke-dashoffset="{{ 502.6 - (502.6 * $taxaSaturacao / 100) }}" 
                            class="{{ $taxaSaturacao > 80 ? 'text-red-500' : 'text-orange-500' }} transition-all duration-1000 ease-out shadow-lg" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-5xl font-black text-slate-800 leading-none">{{ $taxaSaturacao }}%</span>
                        <span class="text-[10px] font-black text-gray-400 uppercase mt-1">Capacidade</span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <div class="bg-orange-50 p-4 rounded-2xl text-center border border-orange-100">
                    <p class="text-[10px] font-black text-orange-600 uppercase mb-1">Ocupadas</p>
                    <p class="text-2xl font-black text-slate-800">{{ $vagasOcupadas }}</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-2xl text-center border border-slate-100">
                    <p class="text-[10px] font-black text-slate-500 uppercase mb-1">Livres</p>
                    <p class="text-2xl font-black text-slate-800">{{ $totalVagas - $vagasOcupadas }}</p>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    @keyframes fade-in { 
        from { opacity: 0; transform: translateY(20px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
    .animate-fade-in { animation: fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>
@endsection