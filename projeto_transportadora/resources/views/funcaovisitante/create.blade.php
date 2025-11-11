@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Novo Visitante</h1>
        <a href="/funcaovisitantes" class="text-sm text-gray-600 hover:underline">Voltar</a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('funcaovisitantes.store') }}">
        @csrf
        <div class="mb-4">
            <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
            <input id="nome" name="nome" value="{{ old('nome') }}" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
            <input id="empresa" name="empresa" value="{{ old('empresa') }}" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label for="funcao" class="block text-sm font-medium text-gray-700 mb-1">Funcao</label>
                <input id="funcao" name="funcao" value="{{ old('funcao') }}" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Periodo</label>
                <input id="periodo" name="periodo" value="{{ old('periodo') }}" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Salvar</button>
            <a href="/funcaovisitantes" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Cancelar</a>
        </div>
    </form>
</div>

@endsection