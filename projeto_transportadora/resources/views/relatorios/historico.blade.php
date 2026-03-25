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
                    <th class="py-3 px-6 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($historico as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    {{-- Formata a data de criação do registro --}}
                    <td class="py-3 px-6">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    
                    {{-- O ?? 'N/A' evita erro se o veículo for deletado do banco --}}
                    <td class="py-3 px-6">{{ $item->veiculo->placa ?? 'Não informado' }}</td>
                    <td class="py-3 px-6">{{ $item->motorista->nome ?? 'Não informado' }}</td>
                    
                    <td class="py-3 px-6 text-center">
                        {{-- O status padrão que vimos na sua migration é 'pendente' --}}
                        <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection