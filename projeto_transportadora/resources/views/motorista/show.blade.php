@extends('layout')

@section('content')


<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Consultar Motorista</h1>
        <a href="{{ route('motoristas.index') }}" class="text-sm text-gray-600 hover:underline">Voltar</a>
    </div>
    <form method="post" action="{{ route('motoristas.destroy', $motorista->id) }}">
        @csrf
        @method('DELETE')
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input value="{{ $motorista->nome }}" type="text" id="nome" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2" disabled>
        </div>
        <div class="mb-4">
            <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
            <input value="{{ $motorista->cpf }}" type="text" id="cpf" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2" disabled>
        </div>
        <div class="mb-4">
            <label for="cnh" class="block text-sm font-medium text-gray-700 mb-1">CNH</label>
            <input value="{{ $motorista->cnh }}" type="text" id="cnh" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2" disabled>
        </div>
        <div class="mb-4">
            <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
            <input value="{{ $motorista->telefone }}" type="text" id="telefone" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2" disabled>
        </div>
        <p class="mb-4">Deseja excluir esse registro?</p>
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Sim</button>
            <a href="{{ route('motoristas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Voltar</a>
        </div>
    </form>
</div>

@endsection