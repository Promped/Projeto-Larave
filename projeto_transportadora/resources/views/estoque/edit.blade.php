@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-4xl mx-auto border-t-8 border-amber-500">
        
        {{-- Cabeçalho Integrado --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('estoque.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Editar Cadastro de Insumo</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Modificando dados do registro: <span class="text-slate-700 font-black font-mono">{{ $insumo->nome }}</span></p>
            </div>
        </div>

        {{-- Formulário --}}
        <form action="{{ route('estoque.update', $insumo->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            {{-- Nome --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nome do Insumo</label>
                <input type="text" name="nome" value="{{ $insumo->nome }}" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
            </div>

            {{-- Local --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Local de Armazenagem</label>
                <select name="local_armazenagem" id="local_armazenagem" class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all cursor-pointer" required onchange="atualizarLimite()">
                    @foreach($areas as $area)
                        <option value="{{ $area->nome }}" 
                            data-capacidade="{{ $area->capacidade }}"
                            {{ $insumo->local_armazenagem == $area->nome ? 'selected' : '' }}>
                            {{ $area->nome }} (Capacidade: {{ $area->capacidade }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Medida --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Unidade de Medida</label>
                <input type="text" name="unidade_medida" value="{{ $insumo->unidade_medida }}" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
            </div>

            {{-- Qtd Atual --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Quantidade Atual (Saldo Físico)</label>
                <input type="number" step="0.01" name="quantidade_atual" value="{{ $insumo->quantidade_atual }}" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all font-mono" required>
            </div>

            {{-- Qtd Mínima --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Quantidade Mínima de Segurança</label>
                <input type="number" step="0.01" name="quantidade_minima" value="{{ $insumo->quantidade_minima }}" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all font-mono" required>
            </div>

            {{-- Limite Máximo --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Limite Máximo Restritivo</label>
                <input type="number" step="0.01" name="limite_maximo" id="limite_maximo" value="{{ $insumo->limite_maximo }}" 
                    class="w-full px-4 py-3 border border-slate-200 bg-slate-100 rounded-xl font-black text-slate-500 text-sm outline-none font-mono" required readonly>
            </div>

            {{-- Ações --}}
            <div class="md:col-span-2 flex justify-end gap-4 mt-6 border-t border-slate-100 pt-6">
                <a href="{{ route('estoque.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all text-center tracking-wider">
                    Cancelar Edição
                </a>
                <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-95 tracking-wider">
                    🔄 Atualizar Registro de Saldo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function atualizarLimite() {
        const select = document.getElementById('local_armazenagem');
        const inputLimite = document.getElementById('limite_maximo');
        const capacidade = select.options[select.selectedIndex].getAttribute('data-capacidade');
        inputLimite.value = capacidade ? capacidade : '';
    }
</script>
@endsection