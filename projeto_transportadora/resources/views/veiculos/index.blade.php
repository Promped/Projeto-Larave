@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Veículos</h2>
        <a href="{{ route('veiculos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Novo Veículo</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if($veiculos->isEmpty())
        <div class="text-center py-12 text-gray-600">Nenhum veículo cadastrado.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Placa</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tipo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Modelo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Transportadora</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($veiculos as $veiculo)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $veiculo->placa }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $veiculo->tipo }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $veiculo->modelo }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $veiculo->transportadora->razao_social ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded text-xs font-medium {{ $veiculo->status_acesso === 'ativo' ? 'bg-green-100 text-green-800' : ($veiculo->status_acesso === 'inativo' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($veiculo->status_acesso) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('veiculos.show', $veiculo->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Ver</a>
                                <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Editar</a>
                                <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja excluir este veículo?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $veiculos->links() }}
        </div>
    @endif
</div>
@endsection