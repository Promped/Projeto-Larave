@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-rose-600">
        
        {{-- Cabeçalho Corporativo --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-rose-50 p-3 rounded-2xl text-2xl text-rose-600 shadow-sm">⚠️</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Gestão de Ocorrências de Pátio</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Registro de sinistros, violações de segurança e bloqueios preventivos</p>
                </div>
            </div>
        </div>

        {{-- Tabela de Ocorrências --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Data / Horário</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Veículo Vinculado</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Gravidade / Tipo</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Descrição do Evento</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                    @forelse($ocorrencias as $oc)
                    <tr class="hover:bg-rose-50/30 transition-colors">
                        {{-- Data/Hora --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-extrabold text-xs">
                            📅 {{ $oc->created_at->format('d/m/Y H:i') }}
                        </td>
                        
                        {{-- Veículo --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($oc->movimentacao?->agendamento?->veiculo?->placa)
                                <span class="bg-slate-100 text-slate-800 font-black px-2.5 py-1 rounded-lg border border-slate-300 text-xs tracking-wider font-mono shadow-sm">
                                    {{ strtoupper($oc->movimentacao->agendamento->veiculo->placa) }}
                                </span>
                            @else
                                <span class="bg-rose-50 border border-rose-200 text-rose-700 px-2 py-1 rounded-lg text-xs font-black uppercase tracking-wider">
                                    🚨 Bloqueio Externo
                                </span>
                            @endif
                        </td>
                        
                        {{-- Tipo de Ocorrência --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-rose-100 border border-rose-200 text-rose-800 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest uppercase shadow-sm">
                                🛡️ {{ $oc->tipo }}
                            </span>
                        </td>
                        
                        {{-- Descrição --}}
                        <td class="px-6 py-4 text-slate-600 text-xs font-medium max-w-md break-words">
                            {{ $oc->descricao }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">✅</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhuma anormalidade ou ocorrência registrada no pátio.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection