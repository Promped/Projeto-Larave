@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Novo Agendamento </h1>
        <p class="text-sm text-gray-600">Reserve uma janela de horário para operação de carga/descarga.</p>
    </div>
        {{-- Alerta de Bloqueio Crítico --}}
@if (session('error_bloqueio'))
    <div class="mb-6 p-5 bg-red-600 text-white rounded-xl shadow-lg border-l-8 border-black animate-bounce">
        <div class="flex items-center">
            <span class="text-3xl mr-4">🚫</span>
            <div>
                <h4 class="font-black uppercase">Veículo Bloqueado no Sistema!</h4>
                <p class="text-sm opacity-90">{{ session('error_bloqueio') }}</p>
            </div>
        </div>
    </div>
@endif
    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Veículo (F_B01) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Veículo (Placa/Modelo)</label>
                <select name="veiculo_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecione o veículo...</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{ $veiculo->id }}">{{ $veiculo->placa }} - {{ $veiculo->modelo }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Motorista (F_B02) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Motorista</label>
                    <select name="motorista_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Selecione o motorista...</option>
                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}" {{ $motorista->status !== 'Ativo' ? 'class=text-red-500' : '' }}>
                                {{ $motorista->nome }} 
                                {{ $motorista->status !== 'Ativo' ? "({$motorista->status})" : "" }}
                            </option>
                        @endforeach
                    </select>
                </div>

            {{-- Carga (F_B03) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipo de Carga</label>
                <select name="carga_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecione a carga...</option>
                    @foreach($cargas as $carga)
                        <option value="{{ $carga->id }}">{{ $carga->tipo }} ({{ $carga->peso }}kg)</option>
                    @endforeach
                </select>
            </div>

            {{-- Vaga no Pátio (F_B07) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Vaga Destino (Área de Operação)</label>
                <select name="vaga_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Selecione a vaga...</option>
                    @foreach($vagas as $vaga)
                        {{-- Exibe a vaga e a área (ex: Celulose ou Madeira) para o usuário não errar --}}
                        <option value="{{ $vaga->id }}">
                            {{ $vaga->identificacao_vaga }} - Área: {{ $vaga->area->nome ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Data e Horário --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Data do Agendamento</label>
                <input type="date" name="data_agendamento" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Início</label>
                    <input type="time" name="horario_inicio" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fim (Previsão)</label>
                    <input type="time" name="horario_fim" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4 border-t pt-4">
            <a href="{{ route('agendamentos.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-bold">
                Confirmar Agendamento
            </button>
        </div>
    </form>
</div>
@endsection