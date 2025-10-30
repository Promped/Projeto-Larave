@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold">Cargas</h2>
        <a href="{{ route('cargas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Carga</a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if($cargas->isEmpty())
        <div class="text-center py-12 text-gray-600">Nenhuma carga cadastrada.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Tipo</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Peso</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Volume</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Veículo</th>
                        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cargas as $carga)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $carga->tipo }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $carga->peso }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $carga->volume }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $carga->veiculo->placa ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('cargas.edit', $carga->id) }}" class="text-blue-600 mr-2">Editar</a>
                                <form action="{{ route('cargas.destroy', $carga->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600" onclick="return confirm('Excluir carga?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $cargas->links() }}</div>
    @endif
</div>
@endsection