@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Detalhes do Veículo</h1>
        <a href="{{ route('veiculos.index') }}" class="text-sm text-gray-600 hover:underline">Voltar</a>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Placa</label>
        <div class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2 bg-gray-50">{{ $veiculo->placa }}</div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
        <div class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2 bg-gray-50">{{ $veiculo->tipo }}</div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Modelo</label>
        <div class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2 bg-gray-50">{{ $veiculo->modelo }}</div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Transportadora</label>
        <div class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2 bg-gray-50">{{ $veiculo->transportadora->razao_social ?? $veiculo->transportadora->nome ?? 'N/A' }}</div>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <div class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2 bg-gray-50">{{ ucfirst($veiculo->status_acesso) }}</div>
    </div>
    <div class="flex items-center gap-3 mt-6">
        <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
        <a href="{{ route('veiculos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">Voltar</a>
    </div>
</div>
@endsection