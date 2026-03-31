@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-800 border-b-2 border-blue-200">📊 F_S01: Relatórios Gerenciais</h2>

    {{-- Alerta de Ocorrências --}}
    @if($ocorrencias > 0)
    <div class="bg-red-600 text-white p-4 rounded-lg shadow-lg mb-8 animate-pulse flex justify-between items-center">
        <div>
            <span class="font-black">🚨 ATENÇÃO:</span> Existem {{ $ocorrencias }} ocorrências pendentes de verificação no pátio!
        </div>
        <a href="{{ route('patio.ocorrencia') }}" class="bg-white text-red-600 px-4 py-1 rounded-full font-bold text-sm hover:bg-gray-100 transition">
            Ver Detalhes
        </a>
    </div>
    @endif

    {{-- Cards de Indicadores --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-100 p-6 rounded-lg shadow border-l-8 border-blue-500">
            <h3 class="text-blue-700 font-bold uppercase text-sm">Total de Agendamentos</h3>
            <p class="text-3xl font-black text-blue-900">{{ $totalAgendamentos }}</p>
        </div>
        
        <div class="bg-yellow-100 p-6 rounded-lg shadow border-l-8 border-yellow-500">
            <h3 class="text-yellow-700 font-bold uppercase text-sm">Pendentes (Em fila)</h3>
            <p class="text-3xl font-black text-yellow-900">{{ $pendentes }}</p>
        </div>

        <div class="bg-green-100 p-6 rounded-lg shadow border-l-8 border-green-500">
            <h3 class="text-green-700 font-bold uppercase text-sm">Concluídos (Saída)</h3>
            <p class="text-3xl font-black text-green-900">{{ $concluidos }}</p>
        </div>

        <div class="{{ $ocorrencias > 0 ? 'bg-red-200 animate-bounce' : 'bg-gray-100' }} p-6 rounded-lg shadow border-l-8 border-red-600">
            <h3 class="text-red-700 font-bold uppercase text-sm">Ocorrências</h3>
            <p class="text-3xl font-black text-red-900">{{ $ocorrencias }}</p>
        </div>
    </div>

    {{-- Lista de Movimentações --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Últimas Movimentações (Histórico Rápido)</h3>
        <ul class="divide-y divide-gray-200">
            @forelse($ultimosAgendamentos as $agendamento)
            <li class="py-4 flex justify-between items-center hover:bg-gray-50 transition px-2 rounded">
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-gray-900">Veículo: {{ $agendamento->veiculo->placa ?? 'N/A' }}</span>
                    <span class="text-xs text-gray-600">Motorista: {{ $agendamento->motorista->nome ?? 'N/A' }}</span>
                    <span class="text-[10px] text-gray-400 uppercase font-semibold">Carga: {{ $agendamento->carga->tipo ?? 'N/A' }}</span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <span class="text-xs text-gray-500 block mb-1">{{ $agendamento->created_at->diffForHumans() }}</span>
                        
                        @php
                            $statusClasses = [
                                'pendente' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                                'No Pátio' => 'bg-blue-100 text-blue-800 border border-blue-300',
                                'concluido' => 'bg-green-600 text-white shadow-sm',
                                'cancelado' => 'bg-red-100 text-red-800'
                            ];
                            $classe = $statusClasses[$agendamento->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp

                        <span class="px-3 py-1 text-xs rounded-full font-bold {{ $classe }}">
                            {{ $agendamento->status == 'concluido' ? '✅ Finalizado' : ucfirst($agendamento->status) }}
                        </span>
                    </div>

                    {{-- Botão TICKET: Removido target="_blank" para abrir na mesma aba --}}
                    <div class="w-24 flex justify-end">
                        @if($agendamento->status == 'concluido')
                            <a href="{{ route('ticket.validar.view', $agendamento->id) }}" 
                               class="flex items-center gap-2 bg-gray-800 hover:bg-black text-white px-3 py-2 rounded text-xs font-bold transition shadow hover:shadow-lg">
                                <i class="fas fa-file-invoice"></i> TICKET
                            </a>
                        @else
                            <button disabled class="opacity-30 cursor-not-allowed flex items-center gap-2 bg-gray-300 text-gray-600 px-3 py-2 rounded text-xs font-bold">
                                <i class="fas fa-lock"></i> TICKET
                            </button>
                        @endif
                    </div>
                </div>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 italic">Nenhuma movimentação registrada hoje.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection