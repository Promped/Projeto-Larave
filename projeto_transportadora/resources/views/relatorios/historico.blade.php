@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-purple-600">
        
        {{-- Cabeçalho Corporativo --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-purple-50 p-3 rounded-2xl text-2xl text-purple-600 shadow-sm">⏱️</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Histórico de Movimentação</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Registro cronológico de fluxo, permanência e transição de estados no pátio</p>
                </div>
            </div>
        </div>

        {{-- Tabela do Histórico --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Data / Horário Registro</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Veículo Identificado</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Condutor / Motorista</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Status no Pátio</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                    @forelse($historico as $item)
                    <tr class="hover:bg-purple-50/20 transition-colors">
                        {{-- Data/Hora --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-extrabold text-xs">
                            📅 {{ $item->created_at->format('d/m/Y H:i') }}
                        </td>
                        
                        {{-- Veículo --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->agendamento?->veiculo?->placa)
                                <span class="bg-slate-100 text-slate-800 font-black px-2.5 py-1 rounded-lg border border-slate-300 text-xs tracking-wider font-mono shadow-sm">
                                    {{ strtoupper($item->agendamento->veiculo->placa) }}
                                </span>
                            @else
                                <span class="text-slate-400 italic text-xs font-medium">N/A</span>
                            @endif
                        </td>
                        
                        {{-- Motorista --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-700 font-bold">
                            👤 {{ $item->agendamento->motorista->nome ?? 'Não Identificado' }}
                        </td>
                        
                        {{-- Status Dinâmico Limpo com Tailwind --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @switch(trim($item->status))
                                @case('Em Espera')
                                    <span class="bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-amber-700 uppercase">Em Espera</span>
                                    @break
                                @case('Em Descarga')
                                    <span class="bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-blue-700 uppercase">Em Descarga</span>
                                    @break
                                @case('Finalizado')
                                    <span class="bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-emerald-700 uppercase">Finalizado</span>
                                    @break
                                @case('Saída Realizada')
                                @case('Saída Realizada ')
                                    <span class="bg-red-50 border border-red-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-red-700 uppercase">Saída Realizada</span>
                                    @break
                                @default
                                    <span class="bg-slate-100 border border-slate-300 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-slate-600 uppercase">{{ $item->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">📦</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhuma movimentação foi registrada no histórico até o momento.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection