@extends('layout')

@section('content')
<div class="container mx-auto p-6 max-w-2xl">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-8 border-blue-600 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">⚙️ Gerenciar Operação: {{ $movimentacao->agendamento->veiculo->placa }}</h2>
        <p class="text-sm text-gray-500 mb-6">Motorista: {{ $movimentacao->agendamento->motorista->nome }}</p>

        <form action="{{ route('movimentacoes.update', $movimentacao->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Status Atual da Operação:</label>
                <select name="status" id="status_select" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <option value="Em Espera" {{ $movimentacao->status == 'Em Espera' ? 'selected' : '' }}>🅿️ Em Espera (No Pátio)</option>
                    <option value="Em Descarga" {{ $movimentacao->status == 'Em Descarga' ? 'selected' : '' }}>🏗️ Em Descarga / Carregamento</option>
                    <option value="Finalizado">✅ Finalizar Operação (Liberar Veículo)</option>
                </select>
            </div>

            <!-- Campo de Peso: Só aparece se o status for 'Finalizado' -->
            <div id="peso_field" class="hidden mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg animate-pulse">
                <label class="block text-sm font-bold text-blue-800 mb-2">Peso Real Confirmado ({{ $movimentacao->agendamento->carga->unidade_medida }}):</label>
                <input type="number" step="0.01" name="peso_real_descarga" placeholder="Ex: 15.50" 
                       class="w-full px-4 py-2 border-2 border-blue-400 rounded-lg outline-none focus:ring-2 focus:ring-blue-600">
                <p class="text-xs text-blue-600 mt-2 italic font-bold">⚠️ Atenção: Ao salvar como FINALIZADO, o saldo será creditado no estoque F_F08.</p>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('movimentacoes.index') }}" class="w-1/2 text-center py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">Voltar</a>
                <button type="submit" class="w-1/2 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-lg transition-colors">Atualizar Movimentação</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('status_select').addEventListener('change', function() {
        const pesoField = document.getElementById('peso_field');
        if (this.value === 'Finalizado') {
            pesoField.classList.remove('hidden');
        } else {
            pesoField.classList.add('hidden');
        }
    });
</script>
@endsection