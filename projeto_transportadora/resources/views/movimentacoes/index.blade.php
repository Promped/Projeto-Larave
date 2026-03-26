@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6 border-b-2 border-blue-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-800">🚚 F_F03: Controle de Fluxo de Pátio</h2>
            <p class="text-sm text-gray-500">Gestão de Entradas, Descargas e Saídas</p>
        </div>
        <a href="{{ route('movimentacoes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold shadow-md transition-all">
            + Registrar Entrada
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($movimentacoes as $mov)
            @php
                $statusColors = [
                    'Em Espera' => 'border-yellow-500 bg-yellow-50 text-yellow-700',
                    'Em Descarga' => 'border-blue-500 bg-blue-50 text-blue-700',
                    'Finalizado' => 'border-green-500 bg-green-50 text-green-700',
                    'Ocorrência' => 'border-red-500 bg-red-50 text-red-700'
                ];
                $estilo = $statusColors[$mov->status] ?? 'border-gray-500 bg-gray-50';
            @endphp

            <div class="border-t-4 shadow-lg rounded-lg p-5 {{ $estilo }} transition-transform hover:scale-105">
                <div class="flex justify-between items-start mb-2">
                    <span class="font-black text-lg">{{ $mov->agendamento->veiculo->placa }}</span>
                    <span class="text-xs font-bold uppercase px-2 py-1 rounded-full border border-current">
                        {{ $mov->status }}
                    </span>
                </div>
                
                <div class="text-sm space-y-1 text-gray-700">
                    <p><strong>Motorista:</strong> {{ $mov->agendamento->motorista->nome }}</p>
                    <p><strong>Carga:</strong> {{ $mov->agendamento->carga->tipo }}</p>
                    <p><strong>Entrada:</strong> {{ $mov->horario_entrada->format('H:i') }}</p>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200 space-y-2">
                    <!-- BOTÃO PARA MUDAR STATUS (O que estava faltando!) -->
                    @if($mov->status != 'Finalizado')
                        <a href="{{ route('movimentacoes.edit', $mov->id) }}" class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-bold transition-colors">
                            ⚙️ Gerenciar Operação
                        </a>
                    @endif

                    <!-- BOTÃO DE SAÍDA -->
                    @if($mov->status == 'Finalizado')
                        <form action="{{ route('movimentacoes.sair', $mov->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-black font-bold">
                                🏁 Confirmar Saída (Portaria)
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <p class="text-gray-500 italic">Nenhum veículo em operação no momento.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection