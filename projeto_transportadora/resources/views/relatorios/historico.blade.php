@extends('layout')  

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4 text-purple-700 underline">F_S02: Histórico de Movimentação</h2>
    
    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-purple-600 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Data/Hora</th>
                    <th class="py-3 px-6 text-left">Veículo</th>
                    <th class="py-3 px-6 text-left">Motorista</th>
                    <th class="py-3 px-6 text-center">Status no Pátio</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($historico as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    
                    {{-- Note que agora acessamos através de agendamento->veiculo --}}
                    <td class="py-3 px-6">{{ $item->agendamento->veiculo->placa ?? 'N/A' }}</td>
                    <td class="py-3 px-6">{{ $item->agendamento->motorista->nome ?? 'N/A' }}</td>
                    
                    <td class="py-3 px-6 text-center">
                        @php
                            // Lógica de cores baseada no status da movimentação
                            $cor = 'bg-gray-200 text-gray-700';
                            if($item->status == 'Em Espera') $cor = 'bg-yellow-200 text-yellow-700';
                            if($item->status == 'Em Descarga') $cor = 'bg-blue-200 text-blue-700';
                            if($item->status == 'Finalizado') $cor = 'bg-green-200 text-green-700';
                            if($item->status == 'Saída Realizada ') $cor = 'bg-red-200 text-red-700';
                        @endphp
                        <span class="{{ $cor }} py-1 px-3 rounded-full text-xs font-bold">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection