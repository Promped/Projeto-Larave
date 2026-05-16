@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-red-600">
        
        <div class="flex items-center justify-between border-b border-slate-100 pb-5 mb-6">
            <div class="flex items-center gap-4">
                <div class="bg-red-50 p-3 rounded-2xl text-2xl text-red-600 shadow-sm">⚠️</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Auditar / Remover Registro</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Ficha detalhada da transportadora homologada</p>
                </div>
            </div>
            <a href="{{ route('transportadoras.index') }}" class="text-xs font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-colors">Voltar à lista</a>
        </div>

        <form method="POST" action="{{ route('transportadoras.destroy', $transportadora->id) }}" class="space-y-5">
            @csrf
            @method('DELETE')

            <div class="bg-slate-50/60 p-6 rounded-2xl border border-slate-100 space-y-4">
                <div>
                    <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Razão Social</label>
                    <p class="text-slate-800 font-extrabold text-base bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm select-all">
                        {{ $transportadora->razao_social ?? $transportadora->descricao ?? 'Não Informado' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Inscrição CNPJ</label>
                        <p class="text-slate-700 font-bold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm select-all">
                            {{ $transportadora->cnpj ?? '---' }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Linha Telefônica</label>
                        <p class="text-slate-700 font-bold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm">
                            {{ $transportadora->telefone ?? '---' }}
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-[9px] font-black text-slate-400 uppercase mb-1 tracking-widest">Localização / Endereço</label>
                    <p class="text-slate-700 font-bold text-sm bg-white border border-slate-200/80 rounded-xl py-3 px-4 shadow-sm">
                        {{ $transportadora->endereco ?? '---' }}
                    </p>
                </div>
            </div>

            <div class="p-4 bg-red-50/80 border border-red-100 rounded-2xl text-center">
                <p class="text-xs font-black text-red-700 uppercase tracking-wide">Deseja remover definitivamente esta transportadora do banco de dados?</p>
                <p class="text-[10px] text-red-400 font-bold uppercase mt-0.5">Essa ação é irreversível e pode afetar históricos de fretes vinculados.</p>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
                <a href="{{ route('transportadoras.index') }}" 
                   class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Não, Cancelar
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-red-600 text-white rounded-xl font-black text-xs uppercase hover:bg-red-700 shadow-lg shadow-red-100 active:scale-95 transition-all">
                    Sim, Excluir Registro 🗑️
                </button>
            </div>
        </form>
    </div>
</div>
@endsection