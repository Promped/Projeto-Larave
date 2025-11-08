@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Funções dos Visitantes</h1>
    <a href="/funcaovisitantes/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Novo Registro</a>
    </div>

    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif
    @if(session('erro'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('erro') }}
        </div>
    @endif

    @if($funcaovisitante->isEmpty())
        <div class="text-gray-500 text-center py-8">Nenhuma função de visitante cadastrada.</div>
    @else
        <div class="overflow-x-auto -mx-6">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Funcao</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periodo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($funcaovisitante as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->nome }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->empresa }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->funcao }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->periodo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/funcaovisitantes/{{ $item->id }}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <a href="/funcaovisitantes/{{ $item->id }}" class="text-blue-600 hover:text-blue-900">Visualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection