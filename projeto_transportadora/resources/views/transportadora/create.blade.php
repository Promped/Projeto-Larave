@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-emerald-600">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-emerald-50 p-3 rounded-2xl text-2xl text-emerald-600 shadow-sm">➕</div>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Nova Transportadora</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Insira um novo parceiro de fretes na malha logística</p>
            </div>
        </div>

        <form method="POST" action="{{ route('transportadoras.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="razao_social" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Razão Social / Nome Fantasia*</label>
                <input type="text" id="razao_social" name="razao_social" placeholder="Ex: Transportes Rápidos S.A." required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('razao_social') border-red-500 @enderror"
                       value="{{ old('razao_social') }}">
                @error('razao_social')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="cnpj" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">CNPJ*</label>
                    <input type="text" id="cnpj" name="cnpj" placeholder="00.000.000/0001-00" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('cnpj') border-red-500 @enderror"
                           value="{{ old('cnpj') }}">
                    @error('cnpj')
                        <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telefone" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Telefone de Contato*</label>
                    <input type="text" id="telefone" name="telefone" placeholder="(00) 00000-0000" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('telefone') border-red-500 @enderror"
                           value="{{ old('telefone') }}">
                    @error('telefone')
                        <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="endereco" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Endereço Operacional*</label>
                <input type="text" id="endereco" name="endereco" placeholder="Rua, Número, Bairro, Cidade - UF" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('endereco') border-red-500 @enderror"
                       value="{{ old('endereco') }}">
                @error('endereco')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">E-mail Corporativo*</label>
                <input type="email" id="email" name="email" placeholder="logistica@empresa.com" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('email') border-red-500 @enderror"
                       value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('transportadoras.index') }}" 
                   class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Voltar
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-black text-xs uppercase hover:bg-emerald-700 shadow-lg shadow-emerald-100 active:scale-95 transition-all">
                    Salvar Cadastro 🚚
                </button>
            </div>
        </form>
    </div>
</div>
@endsection