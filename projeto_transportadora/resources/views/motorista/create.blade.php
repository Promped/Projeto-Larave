@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-emerald-600">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-emerald-50 p-3 rounded-2xl text-2xl text-emerald-600 shadow-sm">➕</div>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Novo Motorista</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Cadastre um condutor habilitado para ordens de carregamento</p>
            </div>
        </div>

        <form method="POST" action="{{ route('motoristas.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="nome" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Nome Completo do Condutor*</label>
                <input type="text" id="nome" name="nome" placeholder="Ex: Roberto Carlos da Silva" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('nome') border-red-500 @enderror"
                       value="{{ old('nome') }}">
                @error('nome')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="cpf" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Cadastro CPF*</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('cpf') border-red-500 @enderror"
                           value="{{ old('cpf') }}">
                    @error('cpf')
                        <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cnh" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Registro CNH*</label>
                    <input type="text" id="cnh" name="cnh" placeholder="00000000000" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('cnh') border-red-500 @enderror"
                           value="{{ old('cnh') }}">
                    @error('cnh')
                        <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="telefone" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Telefone Móvel (WhatsApp)*</label>
                <input type="text" id="telefone" name="telefone" placeholder="(00) 90000-0000" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-inner @error('telefone') border-red-500 @enderror"
                       value="{{ old('telefone') }}">
                @error('telefone')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="transportadora_id" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Vínculo de Frota (Transportadora)*</label>
                <select id="transportadora_id" name="transportadora_id" required
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer @error('transportadora_id') border-red-500 @enderror">
                    <option value="">-- Escolha uma empresa corporativa --</option>
                    @foreach(App\Models\Transportadora::all() as $transportadora)
                        <option value="{{ $transportadora->id }}" {{ old('transportadora_id') == $transportadora->id ? 'selected' : '' }}>
                            🏢 {{ $transportadora->razao_social }}
                        </option>
                    @endforeach
                </select>
                @error('transportadora_id')
                    <p class="text-red-500 text-xs font-bold uppercase tracking-wide mt-1.5 ml-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Status de Liberação em Portaria*</label>
                <select id="status" name="status" required
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-black focus:border-emerald-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                    <option value="Ativo" {{ old('status') == 'Ativo' ? 'selected' : '' }}>🟢 Ativo (Acesso Liberado)</option>
                    <option value="Bloqueado" {{ old('status') == 'Bloqueado' ? 'selected' : '' }}>🔴 Bloqueado (Negar entrada/agendamento)</option>
                    <option value="Inativo" {{ old('status') == 'Inativo' ? 'selected' : '' }}>⚪ Inativo (Sem movimentações)</option>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('motoristas.index') }}" 
                   class="px-6 py-4 bg-slate-100 text-slate-500 rounded-xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Voltar
                </a>
                <button type="submit" 
                        class="px-8 py-4 bg-emerald-600 text-white rounded-xl font-black text-xs uppercase hover:bg-emerald-700 shadow-lg shadow-emerald-100 active:scale-95 transition-all">
                    Registrar Motorista 🪪
                </button>
            </div>
        </form>
    </div>
</div>
@endsection