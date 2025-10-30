@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg">
        <div class="md:flex">
            <div class="w-full px-6 py-8">
                <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">Detalhes do Cliente</h2>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Nome
                    </label>
                    <p class="text-gray-600">{{ $cliente->nome }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Email
                    </label>
                    <p class="text-gray-600">{{ $cliente->email }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Telefone
                    </label>
                    <p class="text-gray-600">{{ $cliente->telefone }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Tem certeza que deseja excluir?')">
                            Excluir
                        </button>
                    </form>
                    <a href="{{ route('clientes.index') }}" class="text-gray-600 hover:text-gray-800">
                        Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection