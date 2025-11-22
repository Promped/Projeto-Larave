@extends('layout')

@section('title', 'Meu Painel')

@php
use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\Transportadora;
@endphp

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Painel de Controle</h1>
    <p class="text-gray-600 mb-4">Visualização de dados</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <button id="btn-veiculos" class="bg-blue-100 p-4 rounded-lg w-full text-left focus:outline-none focus:ring-2 focus:ring-blue-400">
            <h3 class="font-bold text-blue-800">Total de Veículos</h3>
            <p class="text-2xl">{{ Veiculo::count() }}</p>
        </button>
        <button id="btn-motoristas" class="bg-green-100 p-4 rounded-lg w-full text-left focus:outline-none focus:ring-2 focus:ring-green-400">
            <h3 class="font-bold text-green-800">Total de Motoristas</h3>
            <p class="text-2xl">{{ Motorista::count() }}</p>
        </button>
        <button id="btn-transportadoras" class="bg-purple-100 p-4 rounded-lg w-full text-left focus:outline-none focus:ring-2 focus:ring-purple-400">
            <h3 class="font-bold text-purple-800">Total de Transportadoras</h3>
            <p class="text-2xl">{{ Transportadora::count() }}</p>
        </button>
    </div>

    <div class="bg-white border rounded-lg p-6 min-h-[16rem]">
        <h2 id="detalhe-titulo" class="text-xl font-bold mb-4">Selecione um card para ver detalhes</h2>
        <hr id="detalhe-divider" class="my-4 border-t-2 border-gray-200 hidden" />
        <div id="detalhe-conteudo"></div>
    </div>
    <script>
        const veiculos = @json(App\Models\Veiculo::select('placa','tipo','modelo')->get());
        const motoristas = @json(App\Models\Motorista::with('transportadora')->get(['nome','transportadora_id']));
        const transportadoras = @json(App\Models\Transportadora::select('razao_social','telefone')->get());

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btn-veiculos').onclick = function() {
                document.getElementById('detalhe-titulo').innerText = 'Total de Veículos !';
                document.getElementById('detalhe-divider').classList.remove('hidden');
                document.getElementById('detalhe-conteudo').innerHTML = veiculos.length ?
                    `<ul class='list-disc pl-6 space-y-2'>` +
                        veiculos.map(v => `<li class='bg-gray-50 rounded p-2'><b>Placa:</b> ${v.placa || '-'} <span class='mx-2 text-gray-300'>|</span> <b>Tipo:</b> ${v.tipo || '-'} <span class='mx-2 text-gray-300'>|</span> <b>Modelo:</b> ${v.modelo || '-'}</li>`).join('') +
                    `</ul>` : '<p class="text-gray-500"> Nenhum veículo cadastrado. </p>';
            };
            document.getElementById('btn-motoristas').onclick = function() {
                document.getElementById('detalhe-titulo').innerText = 'Total de Motoristas !';
                document.getElementById('detalhe-divider').classList.remove('hidden');
                document.getElementById('detalhe-conteudo').innerHTML = motoristas.length ?
                    `<ul class='list-disc pl-6 space-y-2'>` +
                    motoristas.map(m => `<li class='bg-gray-50 rounded p-2'><b>Nome:</b> ${m.nome || '-'} <span class='mx-2 text-gray-300'>|</span> <b>Transportadora:</b> ${(m.transportadora && m.transportadora.razao_social) ? m.transportadora.razao_social : '-'}</li>`).join('') +
                    `</ul>` : '<p class="text-gray-500">Nenhum motorista cadastrado.</p>';
            };
            document.getElementById('btn-transportadoras').onclick = function() {
                document.getElementById('detalhe-titulo').innerText = 'Total de Transportadoras !';
                document.getElementById('detalhe-divider').classList.remove('hidden');
                document.getElementById('detalhe-conteudo').innerHTML = transportadoras.length ?
                    `<ul class='list-disc pl-6 space-y-2'>` +
                    transportadoras.map(t => `<li class='bg-gray-50 rounded p-2'><b>Razão Social:</b> ${t.razao_social || '-'} <span class='mx-2 text-gray-300'>|</span> <b>Telefone:</b> ${t.telefone || '-'}</li>`).join('') +
                    `</ul>` : '<p class="text-gray-500">Nenhuma transportadora cadastrada.</p>';
            };
        });
    </script>
</div>
@endsection