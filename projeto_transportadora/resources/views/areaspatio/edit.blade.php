@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar Área do Pátio</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('areaspatio.update', $areaspatio->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome*</label>
            <input id="nome" name="nome" value="{{ old('nome', $areaspatio->nome) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
            <input id="descricao" name="descricao" value="{{ old('descricao', $areaspatio->descricao) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="capacidade" class="block text-sm font-medium text-gray-700">Capacidade</label>
            <input id="capacidade" name="capacidade" value="{{ old('capacidade', $areaspatio->capacidade) }}" type="number"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo</label>
            <input id="tipo" name="tipo" value="{{ old('tipo', $areaspatio->tipo) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="disponivel" {{ old('status', $areaspatio->status)=='disponivel' ? 'selected' : '' }}>Disponível</option>
                <option value="indisponivel" {{ old('status', $areaspatio->status)=='indisponivel' ? 'selected' : '' }}>Indisponível</option>
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('areaspatio.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>

@endsection