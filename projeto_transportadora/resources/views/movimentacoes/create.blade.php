@extends('layout')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2 text-center">🆕 Iniciar Fluxo de Entrada</h2>
        
        <form action="{{ route('movimentacoes.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Selecione o Veículo Agendado:</label>
                <select name="agendamento_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <option value="">Aguardando na portaria...</option>
                    @foreach($agendamentosPendentes as $ag)
                        <option value="{{ $ag->id }}">
                            {{ $ag->veiculo->placa ?? 'Sem Placa' }} - {{ $ag->motorista->nome ?? 'Sem Motorista' }} ({{ $ag->carga->tipo ?? 'Carga não definida' }})
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2">*Apenas agendamentos para o dia de hoje aparecem nesta lista.</p>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('movimentacoes.index') }}" class="w-1/2 text-center py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">Cancelar</a>
                <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-lg transition-colors">Registrar Entrada</button>
            </div>
        </form>
    </div>
</div>
@endsection