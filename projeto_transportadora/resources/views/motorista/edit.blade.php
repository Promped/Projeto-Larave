@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📝</div>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Alterar Cadastro do Motorista</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Atualize documentos, contatos corporativos e permissões de acesso</p>
            </div>
        </div>

        <form method="POST" action="{{ route('motoristas.update', $motorista->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nome" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Nome Completo do Condutor*</label>
                <input type="text" id="nome" name="nome" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                       value="{{ old('nome', $motorista->nome) }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="cpf" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Cadastro CPF*</label>
                    <input type="text" id="cpf" name="cpf" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                           value="{{ old('cpf', $motorista->cpf) }}">
                </div>

                <div>
                    <label for="cnh" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Registro CNH*</label>
                    <input type="text" id="cnh" name="cnh" required
                           class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                           value="{{ old('cnh', $motorista->cnh) }}">
                </div>
            </div>

            <div>
                <label for="telefone" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Telefone Móvel (WhatsApp)*</label>
                <input type="text" id="telefone" name="telefone" required
                       class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"
                       value="{{ old('telefone', $motorista->telefone) }}">
            </div>

            <div>
                <label for="transportadora_id" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Vínculo de Frota (Transportadora)*</label>
                <select id="transportadora_id" name="transportadora_id" required
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                    <option value="">-- Escolha uma empresa --</option>
                    @foreach(App\Models\Transportadora::all() as $t)
                        <option value="{{ $t->id }}" {{ old('transportadora_id', $motorista->transportadora_id) == $t->id ? 'selected' : '' }}>
                            🏢 {{ $t->razao_social ?? $t->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="status" class="block text-[10px] font-black text-slate-600 uppercase mb-2 tracking-widest">Status de Liberação em Portaria*</label>
                <select id="status" name="status" required
                        class="w-full bg-slate-50 border-2 border-slate-200 rounded-xl py-3.5 px-5 text-slate-800 font-black focus:border-blue-500 focus:bg-white outline-none transition-all shadow-sm cursor-pointer">
                    @php $s = old('status', $motorista->status); @endphp
                    <option value="Ativo" {{ $s == 'Ativo' ? 'selected' : '' }}>🟢 Ativo (Acesso Liberado)</option>
                    <option value="Bloqueado" {{ $s == 'Bloqueado' ? 'selected' : '' }}>🔴 Bloqueado (Negar entrada/agendamento)</option>
                    <option value="Inativo" {{ $s == 'Inativo' ? 'selected' : '' }}>⚪ Inativo (Sem movimentações)</option>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('motoristas.index') }}" 
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