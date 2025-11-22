@extends('layout')

@section('content')


<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Consultar Visitante</h1>
        <a href="/funcaovisitantes" class="text-sm text-gray-600 hover:underline">Voltar</a>
    </div>
    <form method="post" action="/funcaovisitantes/{{ $funcaovisitante->id }}">
        @csrf
        @method('DELETE')
        <div class="mb-4">
            <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
            <input value="{{$funcaovisitante->descricao}}" type="text" id="descricao" name="descricao" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2" disabled>
        </div>
        <p class="mb-4">Deseja excluir esse registro?</p>
        <div class="flex items-center gap-3">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Sim</button>
            <a href="/funcaovisitantes" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Não</a>
        </div>
    </form>
</div>

@endsection