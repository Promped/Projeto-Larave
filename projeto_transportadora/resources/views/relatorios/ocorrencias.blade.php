@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-red-700 underline">F_F04: Gestão de Ocorrências de Pátio</h2>

    <div class="bg-white shadow-md rounded-xl overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Data/Hora</th>
                    <th class="py-3 px-6 text-left">Veículo</th>
                    <th class="py-3 px-6 text-left">Tipo</th>
                    <th class="py-3 px-6 text-left">Descrição</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($ocorrencias as $oc)
                <tr class="border-b hover:bg-red-50">
                    <td class="py-3 px-6">{{ $oc->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-3 px-6 font-bold">
                        {{ $oc->movimentacao?->agendamento?->veiculo?->placa ?? 'N/A (Bloqueio)' }}
                    </td>
                    <td class="py-3 px-6">
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-bold uppercase">
                            {{ $oc->tipo }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-sm">{{ $oc->descricao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection