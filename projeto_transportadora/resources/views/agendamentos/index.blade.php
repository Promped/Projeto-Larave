@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho da Página --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📅</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Agendamentos de Carga/Descarga</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Planejamento logístico de janelas de horários e ocupação de pátio</p>
                </div>
            </div>
            <a href="{{ route('agendamentos.create') }}" 
               class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Novo Agendamento
            </a>
        </div>

        {{-- Toast de Sucesso --}}
        @if(session('sucesso'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('sucesso') }}
            </div>
        @endif

        {{-- Tabela de Dados --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Data / Janela de Horário</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Veículo Alocado</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Condutor / Motorista</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Vaga Destino (Pátio)</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Status Operação</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                    @forelse($agendamentos as $agendamento)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        {{-- Data e Horário --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-slate-800 font-black block text-sm">
                                📆 {{ date('d/m/Y', strtotime($agendamento->data_agendamento)) }}
                            </span>
                            <span class="text-[11px] font-extrabold text-slate-400 block tracking-wide uppercase mt-0.5">
                                ⏱️ {{ $agendamento->horario_inicio }} até {{ $agendamento->horario_fim }}
                            </span>
                        </td>
                        
                        {{-- Veículo --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-slate-100 text-slate-800 font-black px-2.5 py-1 rounded-lg border border-slate-300 text-xs tracking-wider font-mono shadow-sm">
                                {{ strtoupper($agendamento->veiculo->placa ?? '') }}
                            </span>
                            <span class="text-xs text-slate-500 font-extrabold block mt-1 pl-0.5">
                                {{ $agendamento->veiculo->modelo ?? '' }}
                            </span>
                        </td>
                        
                        {{-- Motorista --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-700 font-bold">
                            👤 {{ $agendamento->motorista->nome ?? 'Não Informado' }}
                        </td>
                        
                        {{-- Vaga no Pátio --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-blue-700 font-black text-sm block">
                                📍 {{ $agendamento->vaga->identificacao_vaga ?? 'N/A' }}
                            </span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider block">
                                Setor: {{ $agendamento->vaga->area->nome ?? 'Geral' }}
                            </span>
                        </td>
                        
                        {{-- Status --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if(strtolower($agendamento->status) === 'pendente')
                                <span class="bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-amber-700 uppercase">Pendente</span>
                            @elseif(strtolower($agendamento->status) === 'concluido' || strtolower($agendamento->status) === 'concluído')
                                <span class="bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-emerald-700 uppercase">Concluído</span>
                            @else
                                <span class="bg-slate-100 border border-slate-300 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-slate-600 uppercase">{{ $agendamento->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">💤</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhum agendamento logístico registrado na grade de hoje.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection