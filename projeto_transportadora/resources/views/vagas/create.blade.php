@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Cadastrar Nova Vaga (F_B07)</h1>
        <p class="text-sm text-gray-600">Vincule uma nova vaga a uma área de pátio existente.</p>
    </div>

    <form action="{{ route('vagas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="area_id" class="block text-sm font-medium text-gray-700 mb-1">Área do Pátio</label>
            <select name="area_id" id="area_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">Selecione uma área...</option>
                @foreach($areas as $area)
                    {{-- Usamos $area->id para salvar no banco e $area->nome para você enxergar --}}
                    <option value="{{ $area->id }}">{{ $area->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="identificacao_vaga" class="block text-sm font-medium text-gray-700 mb-1">Identificação/Número da Vaga</label>
            <input type="text" name="identificacao_vaga" id="identificacao_vaga" placeholder="Ex: Vaga 01, A-10..." required 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

       <div class="mb-6">
    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Inicial</label>
    <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        {{-- O 'value' deve ser exatamente o que está no seu ENUM da migration --}}
        <option value="disponivel">Livre</option> 
        <option value="ocupada">Ocupada</option>
        <option value="manutencao">Manutenção</option>
    </select>
</div>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('vagas.index') }}" class="text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-semibold transition">
                Salvar Vaga
            </button>
        </div>
    </form>
</div>
@endsection