@extends('layout')

@section('content')


<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Alterar Motorista</h2>
    <form method="post" action="{{ route('motoristas.update', $motorista->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input value="{{ $motorista->nome }}" type="text" id="nome" name="nome" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
            <input value="{{ $motorista->cpf }}" type="text" id="cpf" name="cpf" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="cnh" class="block text-sm font-medium text-gray-700">CNH</label>
            <input value="{{ $motorista->cnh }}" type="text" id="cnh" name="cnh" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input value="{{ $motorista->telefone }}" type="text" id="telefone" name="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="transportadora_id" class="block text-sm font-medium text-gray-700">Transportadora</label>
            <select id="transportadora_id" name="transportadora_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Escolha --</option>
                @foreach(App\Models\Transportadora::all() as $t)
                    <option value="{{ $t->id }}" {{ $motorista->transportadora_id == $t->id ? 'selected' : '' }}>{{ $t->razao_social ?? $t->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('motoristas.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>

@endsection