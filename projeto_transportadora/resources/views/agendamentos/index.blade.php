@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Agendamentos de Carga/Descarga</h1>
        <a href="{{ route('agendamentos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-bold">
            Novo Agendamento
        </a>
    </div>

    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">Data/Hora</th>
                    <th class="px-4 py-3 text-left">Veículo</th>
                    <th class="px-4 py-3 text-left">Motorista</th>
                    <th class="px-4 py-3 text-left">Vaga (F_B07)</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($agendamentos as $agendamento)
                <tr>
                    <td class="px-4 py-4">
                        <span class="font-bold">{{ date('d/m/Y', strtotime($agendamento->data_agendamento)) }}</span><br>
                        <span class="text-gray-500">{{ $agendamento->horario_inicio }} - {{ $agendamento->horario_fim }}</span>
                    </td>
                    <td class="px-4 py-4">{{ $agendamento->veiculo->placa }} ({{ $agendamento->veiculo->modelo }})</td>
                    <td class="px-4 py-4">{{ $agendamento->motorista->nome }}</td>
                    <td class="px-4 py-4">
                        <span class="font-semibold text-blue-700">{{ $agendamento->vaga->identificacao_vaga }}</span><br>
                        <span class="text-xs text-gray-500">{{ $agendamento->vaga->area->nome ?? 'N/A' }}</span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                            {{ $agendamento->status == 'pendente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($agendamento->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-10 text-center text-gray-500 italic">Nenhum agendamento encontrado para hoje.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection