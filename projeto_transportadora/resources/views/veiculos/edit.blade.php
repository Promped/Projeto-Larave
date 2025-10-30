@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar Veículo</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="placa" class="block text-sm font-medium text-gray-700">Placa*</label>
            <input type="text" name="placa" id="placa" value="{{ old('placa', $veiculo->placa) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo*</label>
            <select name="tipo" id="tipo" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Selecione...</option>
                <option value="Caminhão" {{ old('tipo', $veiculo->tipo) == 'Caminhão' ? 'selected' : '' }}>Caminhão</option>
                <option value="Van" {{ old('tipo', $veiculo->tipo) == 'Van' ? 'selected' : '' }}>Van</option>
                <option value="Carreta" {{ old('tipo', $veiculo->tipo) == 'Carreta' ? 'selected' : '' }}>Carreta</option>
            </select>
        </div>

        <div>
            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo*</label>
            <input type="text" name="modelo" id="modelo" value="{{ old('modelo', $veiculo->modelo) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="transportadora_id" class="block text-sm font-medium text-gray-700">Transportadora*</label>
            <select name="transportadora_id" id="transportadora_id" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Selecione...</option>
                @foreach($transportadoras as $transportadora)
                    <option value="{{ $transportadora->id }}" {{ old('transportadora_id', $veiculo->transportadora_id) == $transportadora->id ? 'selected' : '' }}>
                        {{ $transportadora->razao_social ?? $transportadora->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status_acesso" class="block text-sm font-medium text-gray-700">Status de Acesso*</label>
            <select name="status_acesso" id="status_acesso" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="ativo" {{ old('status_acesso', $veiculo->status_acesso) == 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="inativo" {{ old('status_acesso', $veiculo->status_acesso) == 'inativo' ? 'selected' : '' }}>Inativo</option>
                <option value="bloqueado" {{ old('status_acesso', $veiculo->status_acesso) == 'bloqueado' ? 'selected' : '' }}>Bloqueado</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('veiculos.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>
@endsection