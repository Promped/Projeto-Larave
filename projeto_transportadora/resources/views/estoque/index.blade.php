@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        {{-- Painel de Título Operacional --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Controle de Estoque Central</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Monitoramento de cubagem e insumos em pátio integrado com fluxos de portaria</p>
            </div>
            
            <div class="flex items-center gap-3">
                <span class="bg-blue-50 border border-blue-100 text-blue-700 text-[10px] font-black px-3 py-1.5 rounded-xl uppercase tracking-wider">
                    Sincronizado em Tempo Real
                </span>
                <a href="{{ route('estoque.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider flex items-center">
                    <span class="mr-1.5 text-sm font-normal">+</span> Inserir Insumo
                </a>
            </div>
        </div>

        {{-- Painel da Tabela Geral --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Classificação / Material</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Área de Pátio</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Cubagem / Saldo Atual</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Status Crítico</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-xs">
                    @forelse($insumos as $insumo)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        
                        {{-- Identificação do Insumo --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-slate-800 font-black text-sm uppercase tracking-tight mb-0.5">{{ $insumo->nome }}</p>
                            <p class="text-slate-400 text-[10px] font-mono tracking-wider">SKU: #{{ str_pad($insumo->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </td>

                        {{-- Área Vinculada --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-slate-100 text-slate-600 font-black px-2.5 py-1.5 rounded-xl border border-slate-200 text-[10px] tracking-wide uppercase">
                                📍 {{ $insumo->local_armazenagem }}
                            </span>
                        </td>

                        {{-- Volumetria e Barra de Progresso --}}
                        <td class="px-6 py-4 whitespace-nowrap w-64">
                            <div class="flex flex-col">
                                <span class="text-slate-800 font-black font-mono text-xs">
                                    {{ number_format($insumo->quantidade_atual, 2, ',', '.') }} <span class="text-slate-400 font-sans font-bold uppercase text-[10px]">{{ $insumo->unidade_medida }}</span> 
                                    <span class="text-slate-300 font-sans font-medium text-[11px]">/ {{ number_format($insumo->limite_maximo, 2, ',', '.') }}</span>
                                </span>
                                
                                {{-- Lógica de Coloração de Ocupação Industrial --}}
                                @php
                                    $porcentagem = ($insumo->limite_maximo > 0) ? ($insumo->quantidade_atual / $insumo->limite_maximo) * 100 : 0;
                                    $corBarra = 'bg-blue-600';
                                    if($insumo->quantidade_atual <= $insumo->quantidade_minima) $corBarra = 'bg-rose-500';
                                    elseif($porcentagem >= 90) $corBarra = 'bg-amber-500';
                                @endphp
                                
                                <div class="w-full bg-slate-100 border border-slate-200 rounded-full h-2 mt-2 shadow-inner overflow-hidden">
                                    <div class="{{ $corBarra }} h-full transition-all duration-500" 
                                         style="width: {{ min($porcentagem, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Badges de Status Operacionais --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($insumo->quantidade_atual <= $insumo->quantidade_minima)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-rose-50 border border-rose-200 text-rose-700 animate-pulse uppercase tracking-wider">
                                    🚨 Crítico: Repor
                                </span>
                            @elseif($porcentagem >= 90)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-amber-50 border border-amber-200 text-amber-700 uppercase tracking-wider">
                                    ⚠️ Pátio Lotado
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-emerald-50 border border-emerald-200 text-emerald-700 uppercase tracking-wider">
                                    ✅ Estável
                                </span>
                            @endif
                        </td>

                        {{-- Ações Diretas --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('estoque.edit', $insumo->id) }}" class="text-blue-600 hover:text-blue-800 font-black text-[10px] uppercase tracking-wider transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('estoque.destroy', $insumo->id) }}" method="POST" onsubmit="return confirm('Deseja realmente arquivar/remover este registro de estoque do pátio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-black text-[10px] uppercase tracking-wider transition-colors">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">📦</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhum registro de insumo ou volumetria ativa em pátio.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection