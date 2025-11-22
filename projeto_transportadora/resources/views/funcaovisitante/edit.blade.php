@extends('layout')

@section('content')

<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar Visitante</h2>
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="/funcaovisitantes/{{ $funcaovisitante->id }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input value="{{$funcaovisitante->nome}}" type="text" id="nome" name="nome" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="empresa" class="block text-sm font-medium text-gray-700">Empresa</label>
            <input value="{{$funcaovisitante->empresa}}" type="text" id="empresa" name="empresa" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="funcao" class="block text-sm font-medium text-gray-700">Função</label>
            <input value="{{$funcaovisitante->funcao}}" type="text" id="funcao" name="funcao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div>
            <label for="periodo" class="block text-sm font-medium text-gray-700">Período</label>
            <input value="{{$funcaovisitante->periodo}}" type="text" id="periodo" name="periodo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        </div>
        <div class="flex justify-end gap-2">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>

@endsection