@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex items-center mb-6 border-b-2 border-green-200 pb-4">
        <a href="{{ route('estoque.index') }}" class="mr-4 text-green-600 hover:text-green-800 transition-colors">
            ⬅️ Voltar
        </a>
        <h2 class="text-2xl font-bold text-green-800">🆕 Cadastrar Novo Insumo</h2>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200 p-8">
        <form action="{{ route('estoque.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Nome do Insumo --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome do Insumo</label>
                <input type="text" name="nome" placeholder="Ex: Cimento CP-II, Areia Fina, Bruta..." 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            {{-- Local de Armazenagem Dinâmico (Vindo de F_B07) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Local de Armazenagem (Áreas do Pátio)</label>
                <select name="local_armazenagem" id="local_armazenagem" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required onchange="atualizarLimite()">
                    <option value="" data-capacidade="0">Selecione uma área...</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->nome }}" data-capacidade="{{ $area->capacidade }}">
                            {{ $area->nome }} (Capacidade: {{ $area->capacidade }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Unidade de Medida --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Unidade de Medida</label>
                <input type="text" name="unidade_medida" placeholder="Ex: kg, un, m³, litros" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            {{-- Quantidade Atual --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quantidade Atual (Saldo)</label>
                <input type="number" step="0.01" name="quantidade_atual" value="0" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            {{-- Quantidade Mínima --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quantidade Mínima (Alerta 🚨)</label>
                <input type="number" step="0.01" name="quantidade_minima" placeholder="Ex: 10" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            {{-- Limite Máximo Automatizado --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Limite Máximo (Capacidade Total da Área)</label>
                <input type="number" step="0.01" name="limite_maximo" id="limite_maximo" placeholder="Selecione uma área para carregar o limite" 
                    class="w-full px-4 py-2 border bg-gray-50 rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required readonly>
                <p class="text-xs text-gray-500 mt-1 italic">*Este valor é preenchido automaticamente com base na capacidade da área escolhida (F_B07).</p>
            </div>

            <div class="md:col-span-2 flex justify-end gap-4 mt-4">
                <button type="reset" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                    Limpar
                </button>
                <button type="submit" class="px-6 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 shadow-lg transition-colors">
                    💾 Salvar Insumo
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script para preencher o limite automaticamente --}}
<script>
    function atualizarLimite() {
        const select = document.getElementById('local_armazenagem');
        const inputLimite = document.getElementById('limite_maximo');
        const capacidade = select.options[select.selectedIndex].getAttribute('data-capacidade');
        
        inputLimite.value = capacidade;
    }
</script>
@endsection