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

<form method="post" action="/funcaovisitantes/{{ $funcaovisitante->id }}">
    @CSRF
    @METHOD('PUT')
    <div class="mb-3">
        <label for="nome" class="block text-sm font-medium text-gray-700" class="form-label">Informe o nome:</label>
        <input value="{{$funcaovisitante->nome}}" type="text" id="nome" name="nome" class="form-control" required=""
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
    </div>

    <div class="mb-3">
        <label for="empresa" class="block text-sm font-medium text-gray-700" class="form-label">Informe a empresa:</label>
        <input value="{{$funcaovisitante->empresa}}" type="text" id="empresa" name="empresa" class="form-control" required=""\
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
    </div>

    <div class="mb-3">
        <label for="funcao" class="block text-sm font-medium text-gray-700" class="form-label">Informe a funcao:</label>
        <input value="{{$funcaovisitante->funcao}}" type="text" id="funcao" name="funcao" class="form-control" required=""
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
    </div>

    <div class="mb-3">
        <label for="periodo" class="block text-sm font-medium text-gray-700" class="form-label">Informe o periodo:</label>
        <input value="{{$funcaovisitante->periodo}}" type="text" id="periodo" name="periodo" class="form-control" required=""
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"/>
    </div>
    
    <div class="flex justify-end gap-2">
        <a href="{{ route('areaspatio.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
    </div>
    </form>
</div>

@endsection