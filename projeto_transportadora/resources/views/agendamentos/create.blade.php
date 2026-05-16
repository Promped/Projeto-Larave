@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-4xl mx-auto border-t-8 border-blue-600">
        
        {{-- Título / Subtítulo --}}
        <div class="mb-8 border-b border-slate-100 pb-6">
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Novo Agendamento Logístico</h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-1">Reserve e planeje uma janela de horário exclusiva para a operação de entrada ou saída</p>
        </div>

        {{-- Alerta de Bloqueio Crítico (Veículo Impedido) --}}
        @if (session('error_bloqueio'))
            <div class="mb-8 p-5 bg-red-500 border border-red-600 text-white rounded-2xl shadow-lg shadow-red-100 animate-pulse">
                <div class="flex items-center gap-4">
                    <span class="text-3xl">🚫</span>
                    <div>
                        <h4 class="font-black text-sm uppercase tracking-wide">Restrição de Segurança Detectada!</h4>
                        <p class="text-xs font-bold uppercase tracking-wider opacity-90 mt-0.5">{{ session('error_bloqueio') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('agendamentos.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Veículo --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Veículo Operacional (Placa / Modelo)</label>
                    <select name="veiculo_id" required 
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="">Selecione o veículo...</option>
                        @foreach($veiculos as $veiculo)
                            <option value="{{ $veiculo->id }}">{{ strtoupper($veiculo->placa) }} — {{ $veiculo->modelo }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Motorista --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Motorista Escala / Condutor</label>
                    <select name="motorista_id" required 
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="">Selecione o motorista...</option>
                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}" {{ $motorista->status !== 'Ativo' ? 'class=text-red-500' : '' }}>
                                👤 {{ $motorista->nome }} 
                                {{ $motorista->status !== 'Ativo' ? "({$motorista->status})" : "" }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Carga --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Tipo de Mercadoria / Carga</label>
                    <select name="carga_id" required 
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="">Selecione a carga...</option>
                        @foreach($cargas as $carga)
                            <option value="{{ $carga->id }}">📦 {{ $carga->tipo }} ({{ number_format($carga->peso, 0, ',', '.') }} kg)</option>
                        @endforeach
                    </select>
                </div>

                {{-- Vaga no Pátio --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Vaga Destino (Alocação de Pátio)</label>
                    <select name="vaga_id" required 
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                        <option value="">Selecione a vaga...</option>
                        @foreach($vagas as $vaga)
                            <option value="{{ $vaga->id }}">
                                📍 Vaga: {{ $vaga->identificacao_vaga }} — Área: {{ $vaga->area->nome ?? 'Geral' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Data do Agendamento --}}
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Data Programada</label>
                    <input type="date" name="data_agendamento" required 
                           class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                </div>

                {{-- Janelas Horárias (Início e Fim) --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Início Janela</label>
                        <input type="time" name="horario_inicio" required 
                               class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Previsão Fim</label>
                        <input type="time" name="horario_fim" required 
                               class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
                    </div>
                </div>
            </div>

            {{-- Botões de Rodapé --}}
            <div class="mt-10 flex justify-end items-center gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('agendamentos.index') }}" 
                   class="px-5 py-2.5 text-xs font-black text-slate-400 uppercase tracking-wider hover:text-slate-600 transition-colors">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95">
                    Confirmar Agendamento
                </button>
            </div>
        </form>
    </div>
</div>
@endsection