@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-5xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">🚚</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Liberação de Saída</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">F_F05 • Veículos com operação concluída aguardando portaria</p>
                </div>
            </div>
            <span class="bg-amber-50 border border-amber-200 text-amber-700 text-[10px] font-black px-3 py-1.5 rounded-xl uppercase tracking-wider animate-pulse">
                Aguardando Conferência
            </span>
        </div>

        {{-- Alertas de Sucesso --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Tabela de Triagem --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Veículo / Placa</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Motorista Vinculado</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Status Operacional</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Ações de Triagem</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                    @forelse($pendentes as $p)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        {{-- Placa --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-slate-100 text-slate-800 font-black px-3 py-1.5 rounded-xl border border-slate-300 text-xs tracking-wider font-mono shadow-sm">
                                {{ strtoupper($p->agendamento->veiculo->placa ?? 'N/A') }}
                            </span>
                        </td>
                        
                        {{-- Motorista --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-700 font-bold text-xs uppercase">
                            {{ $p->agendamento->motorista->nome ?? 'Não Informado' }}
                        </td>
                        
                        {{-- Status --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1.5 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-xl text-[10px] font-black uppercase tracking-wide">
                                {{ $p->status }}
                            </span>
                        </td>
                        
                        {{-- Botão Ação --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="{{ route('liberacao.show', $p->id) }}" 
                               class="inline-block px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-[10px] uppercase rounded-xl shadow-md shadow-emerald-100 transition-all active:scale-95 tracking-wider">
                                Iniciar Conferência
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">🛣️</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhum veículo aguardando liberação de saída no momento.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection