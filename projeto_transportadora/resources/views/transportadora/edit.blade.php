@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📝</div>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Alterar Transportadora</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Atualize as informações cadastrais e de contato do parceiro</p>
            </div>
        </div>

        <form method="POST" action="{{ route('transportadoras.update', $transportadora->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="razao_social" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Razão Social / Nome Fantasia*</label>
                <input type="text" id="razao_social" name="razao_social" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                       value="{{ $transportadora->razao_social ?? $transportadora->descricao ?? '' }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="cnpj" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">CNPJ*</label>
                    <input type="text" id="cnpj" name="cnpj" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                           value="{{ $transportadora->cnpj ?? '' }}">
                </div>

                <div>
                    <label for="telefone" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Telefone de Contato*</label>
                    <input type="text" id="telefone" name="telefone" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                           value="{{ $transportadora->telefone ?? '' }}">
                </div>
            </div>

            <div>
                <label for="endereco" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Endereço Operacional*</label>
                <input type="text" id="endereco" name="endereco" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                       value="{{ $transportadora->endereco ?? '' }}">
            </div>

            <div>
                <label for="email" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">E-mail Corporativo*</label>
                <input type="email" id="email" name="email" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                       value="{{ $transportadora->email ?? '' }}">
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('transportadoras.index') }}" 
                   class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-blue-600 text-white rounded-xl font-black text-xs uppercase hover:bg-blue-700 shadow-lg shadow-blue-100 active:scale-95 transition-all">
                    Atualizar Dados 💾
                </button>
            </div>
        </form>
    </div>
</div>
@endsection