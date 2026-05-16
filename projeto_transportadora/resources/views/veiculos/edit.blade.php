@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📝</div>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Editar Cadastro do Veículo</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Modifique categorias estruturais e travas de segurança de entrada</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl text-red-800 font-bold text-xs uppercase tracking-wider">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('veiculos.update', $veiculo->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="placa" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Placa do Veículo*</label>
                    <input type="text" name="placa" id="placa" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-mono font-black tracking-wider uppercase focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner focus:ring-0" 
                           value="{{ old('placa', $veiculo->placa) }}" />
                </div>

                <div>
                    <label for="tipo" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Tipo de Categoria*</label>
                    <select name="tipo" id="tipo" required 
                            class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-black focus:border-blue-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                        <option value="Caminhão" {{ old('tipo', $veiculo->tipo) == 'Caminhão' ? 'selected' : '' }}>Dimensão: Caminhão</option>
                        <option value="Van" {{ old('tipo', $veiculo->tipo) == 'Van' ? 'selected' : '' }}>Dimensão: Van</option>
                        <option value="Carreta" {{ old('tipo', $veiculo->tipo) == 'Carreta' ? 'selected' : '' }}>Dimensão: Carreta</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="modelo" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Modelo / Especificação do Fabricante*</label>
                <input type="text" name="modelo" id="modelo" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner" 
                       value="{{ old('modelo', $veiculo->modelo) }}" />
            </div>

            <div>
                <label for="transportadora_id" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Transportadora / Frota Proprietária*</label>
                <select name="transportadora_id" id="transportadora_id" required 
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                    @foreach($transportadoras as $transportadora)
                        <option value="{{ $transportadora->id }}" {{ old('transportadora_id', $veiculo->transportadora_id) == $transportadora->id ? 'selected' : '' }}>
                            🏢 {{ $transportadora->razao_social ?? $transportadora->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status_acesso" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Diretriz de Segurança (Acesso Pátio)*</label>
                <select name="status_acesso" id="status_acesso" required 
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-black focus:border-blue-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                    <option value="ativo" {{ old('status_acesso', $veiculo->status_acesso) == 'ativo' ? 'selected' : '' }}>🟢 Ativo / Liberado para Agendamentos</option>
                    <option value="inativo" {{ old('status_acesso', $veiculo->status_acesso) == 'inativo' ? 'selected' : '' }}>⚪ Inativo / Fora de Operação</option>
                    <option value="bloqueado" {{ old('status_acesso', $veiculo->status_acesso) == 'bloqueado' ? 'selected' : '' }}>🔴 Bloqueado / Restrição de Entrada</option>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('veiculos.index') }}" 
                   class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-blue-600 text-white rounded-xl font-black text-xs uppercase hover:bg-blue-700 shadow-lg shadow-blue-100 active:scale-95 transition-all">
                    Atualizar Veículo 💾
                </button>
            </div>
        </form>
    </div>
</div>
@endsection