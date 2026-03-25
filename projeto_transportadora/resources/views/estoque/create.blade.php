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

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome do Insumo</label>
                <input type="text" name="nome" placeholder="Ex: Cimento CP-II, Areia Fina, Bruta..." 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Local de Armazenagem</label>
                <select name="local_armazenagem" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
                    <option value="Almoxarifado">Almoxarifado</option>
                    <option value="Pátio A">Pátio A</option>
                    <option value="Pátio B">Pátio B</option>
                    <option value="Galpão Central">Galpão Central</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Unidade de Medida</label>
                <input type="text" name="unidade_medida" placeholder="Ex: kg, un, m³, litros" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quantidade Atual (Saldo)</label>
                <input type="number" step="0.01" name="quantidade_atual" value="0" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quantidade Mínima (Alerta 🚨)</label>
                <input type="number" step="0.01" name="quantidade_minima" placeholder="Ex: 10" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Limite Máximo (Capacidade Total)</label>
                <input type="number" step="0.01" name="limite_maximo" placeholder="Ex: 1000" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 outline-none" required>
                <p class="text-xs text-gray-500 mt-1 italic">*Este valor é usado para calcular a barra de progresso e o status "Pátio Lotado".</p>
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
@endsection