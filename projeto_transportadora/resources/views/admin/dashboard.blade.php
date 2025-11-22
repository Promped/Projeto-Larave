@extends('layout')

@section('title', 'Meu Painel')

@php
use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\Transportadora;
@endphp

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    <p class="text-gray-600 mb-4">Visualização de dados</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-100 p-4 rounded-lg">
            <h3 class="font-bold text-blue-800">Total de Veículos</h3>
            <p class="text-2xl">{{ Veiculo::count() }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg">
            <h3 class="font-bold text-green-800">Total de Motoristas</h3>
            <p class="text-2xl">{{ Motorista::count() }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded-lg">
            <h3 class="font-bold text-purple-800">Total de Transportadoras</h3>
            <p class="text-2xl">{{ Transportadora::count() }}</p>
        </div>
    </div>

    <div class="bg-white border rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Vendas Mensais</h2>
        <!-- Aqui você pode adicionar seus gráficos ou mais estatísticas -->
        <div class="h-64">
            <!-- Placeholder para gráfico -->
            <p class="text-gray-500">Gráfico de vendas mensais será exibido aqui</p>
        </div>
    </div>
</div>
@endsection