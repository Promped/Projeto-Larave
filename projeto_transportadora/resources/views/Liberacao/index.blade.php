@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black uppercase italic text-[#0046AD]">Liberação de Saída</h2>
        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase">Aguardando Conferência</span>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4">Veículo/Placa</th>
                    <th class="px-6 py-4">Motorista</th>
                    <th class="px-6 py-4">Status Atual</th>
                    <th class="px-6 py-4 text-center">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pendentes as $p)
                <tr class="hover:bg-blue-50/50 transition-all">
                    <td class="px-6 py-4 font-bold text-gray-700">
                        {{ $p->agendamento->veiculo->placa }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $p->agendamento->motorista->nome }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-black uppercase">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('liberacao.show', $p->id) }}" 
                           class="bg-[#00A859] text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#008f4c] transition-all shadow-md shadow-green-100">
                            INICIAR CONFERÊNCIA
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                        Nenhum veículo aguardando liberação no momento.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection