@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Editar Carga</h2>
    <form action="{{ route('cargas.update', $carga->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Tipo <span class="text-red-500">*</span></label>
            <input type="text" name="tipo" value="{{ old('tipo', $carga->tipo) }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Volume</label>
            <input type="number" step="0.01" name="volume" value="{{ old('volume', $carga->volume) }}" class="w-full border rounded px-3 py-2 mt-1">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Veículo</label>
            <select name="veiculo_id" class="w-full border rounded px-3 py-2 mt-1" required>
                @foreach($veiculos as $veiculo)
                    <option value="{{ $veiculo->id }}" {{ $carga->veiculo_id == $veiculo->id ? 'selected' : '' }}>{{ $veiculo->placa }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Motorista</label>
            <select name="motorista_id" class="w-full border rounded px-3 py-2 mt-1" required>
                @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}" {{ $carga->motorista_id == $motorista->id ? 'selected' : '' }}>{{ $motorista->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700">Peso (kg)</label>
            <input type="number" name="peso" value="{{ old('peso', $carga->peso) }}" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('cargas.index') }}" class="text-gray-600 hover:underline px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
        </div>
    </form>
</div>
@endsection
