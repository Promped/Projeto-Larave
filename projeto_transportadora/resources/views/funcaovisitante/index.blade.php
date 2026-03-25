@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Funções dos Visitantes</h1>
        <a href="{{ route('funcaovisitantes.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
            Novo Registro
        </a>
    </div>

    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    @if($funcaovisitante->isEmpty())
        <div class="text-gray-500 text-center py-8">Nenhuma função de visitante cadastrada.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-8 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-8 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                        <th class="px-8 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                        <th class="px-8 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Função</th>
                        <th class="px-8 py-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                        <th class="px-8 py-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($funcaovisitante as $item)
                    <tr>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900">{{ $item->descricao }}</td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900">{{ $item->empresa }}</td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900">{{ $item->funcao }}</td>
                        <td class="px-8 py-6 whitespace-nowrap text-sm text-gray-900">{{ $item->periodo }}</td>
                        <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('funcaovisitantes.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <a href="{{ route('funcaovisitantes.show', $item->id) }}" class="text-blue-600 hover:text-blue-900">Visualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection