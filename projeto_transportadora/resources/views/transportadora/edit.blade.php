@extends('layout')

@section('content')


<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Alterar Transportadora</h2>
    <form method="post" action="{{ route('transportadoras.update', $transportadora->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="razao_social" class="block text-sm font-medium text-gray-700">Razão Social</label>
            <input value="{{ $transportadora->razao_social ?? $transportadora->descricao ?? '' }}" type="text" id="razao_social" name="razao_social" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
            <input value="{{ $transportadora->cnpj ?? '' }}" type="text" id="cnpj" name="cnpj" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
            <input value="{{ $transportadora->endereco ?? '' }}" type="text" id="endereco" name="endereco" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input value="{{ $transportadora->telefone ?? '' }}" type="text" id="telefone" name="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input value="{{ $transportadora->email ?? '' }}" type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ route('transportadoras.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>

@endsection