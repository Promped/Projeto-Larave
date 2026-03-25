@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-800 border-b-2 border-blue-200">📊 F_S01: Relatórios Gerenciais</h2>

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

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Últimas Movimentações (Histórico Rápido)</h3>
        <ul class="divide-y divide-gray-200">
            @forelse($ultimosAgendamentos as $agendamento)
            <li class="py-3 flex justify-between items-center">
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-gray-900">Veículo: {{ $agendamento->veiculo->placa ?? 'N/A' }}</span>
                    <span class="text-xs text-gray-400">Motorista: {{ $agendamento->motorista->nome ?? 'N/A' }}</span>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-500 block mb-1">{{ $agendamento->created_at->diffForHumans() }}</span>
                    <span class="px-2 py-1 text-xs rounded font-bold {{ $agendamento->status == 'pendente' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                        {{ ucfirst($agendamento->status) }}
                    </span>
                </div>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 italic">Nenhuma movimentação registrada hoje.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection