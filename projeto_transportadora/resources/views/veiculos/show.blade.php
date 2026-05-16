@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-slate-800">
        
        <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
            <div class="flex items-center gap-4">
                <div class="bg-slate-100 p-3 rounded-2xl text-2xl text-slate-700 shadow-sm">🔍</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Detalhes do Veículo</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Ficha de vistoria, dados corporativos e restrições de tráfego</p>
                </div>
            </div>
            <a href="{{ route('veiculos.index') }}" class="text-xs font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Voltar</a>
        </div>

        <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100 space-y-4">
            <div>
                <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Placa Identificadora</label>
                <div class="inline-block text-slate-800 font-mono font-black text-lg bg-white border-2 border-slate-300 rounded-xl py-2.5 px-5 shadow-sm uppercase select-all tracking-wider">
                    {{ $veiculo->placa }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Tipo de Carroceria</label>
                    <p class="text-slate-700 font-extrabold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm uppercase">
                        {{ $veiculo->tipo }}
                    </p>
                </div>

                <div>
                    <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Modelo / Especificação</label>
                    <p class="text-slate-700 font-extrabold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm">
                        {{ $veiculo->modelo }}
                    </p>
                </div>
            </div>

            <div>
                <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Empresa / Transportadora Vinculada</label>
                <p class="text-slate-700 font-extrabold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm">
                    🏢 {{ $veiculo->transportadora->razao_social ?? $veiculo->transportadora->nome ?? 'Frota não vinculada (Autônomo)' }}
                </p>
            </div>

            <div>
                <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Status de Permissão em Portaria</label>
                <div class="inline-flex items-center">
                    @if(strtolower($veiculo->status_acesso) === 'ativo')
                        <span class="bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-xl text-xs font-black tracking-widest text-emerald-700 uppercase">🟢 Ativo / Liberado</span>
                    @elseif(strtolower($veiculo->status_acesso) === 'bloqueado')
                        <span class="bg-red-50 border border-red-200 px-4 py-2 rounded-xl text-xs font-black tracking-widest text-red-700 uppercase">🔴 Acesso Bloqueado</span>
                    @else
                        <span class="bg-amber-50 border border-amber-200 px-4 py-2 rounded-xl text-xs font-black tracking-widest text-amber-700 uppercase">Inativo</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
            <a href="{{ route('veiculos.index') }}" 
               class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                Voltar à Listagem
            </a>
            <a href="{{ route('veiculos.edit', $veiculo->id) }}" 
               class="px-8 py-4 bg-blue-600 text-white rounded-xl font-black text-xs uppercase hover:bg-blue-700 shadow-lg shadow-blue-100 active:scale-95 transition-all">
                Editar Cadastro 📝
            </a>
        </div>
    </div>
</div>
@endsection