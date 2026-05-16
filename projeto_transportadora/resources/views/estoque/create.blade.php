@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-4xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho Integrado --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('estoque.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Cadastrar Novo Insumo</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Inclusão de materiais para controle de cubagem e volumetria de pátio</p>
            </div>
        </div>

        {{-- Formulário com Grid Técnico --}}
        <form action="{{ route('estoque.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Nome do Insumo --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nome do Insumo</label>
                <input type="text" name="nome" placeholder="Ex: Cimento CP-II, Areia Fina, Brita 1..." 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
            </div>

            {{-- Local de Armazenagem Dinâmico --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Local de Armazenagem (Área de Destino)</label>
                <div class="relative">
                    <select name="local_armazenagem" id="local_armazenagem" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all appearance-none cursor-pointer" required onchange="atualizarLimite()">
                        <option value="" data-capacidade="0">Selecione uma área operacional...</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->nome }}" data-capacidade="{{ $area->capacidade }}">
                                {{ $area->nome }} (Capacidade: {{ $area->capacidade }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Unidade de Medida --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Unidade de Medida</label>
                <input type="text" name="unidade_medida" placeholder="Ex: kg, un, m³, Litros" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
            </div>

            {{-- Quantidade Atual --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Quantidade Inicial (Saldo em Pátio)</label>
                <input type="number" step="0.01" name="quantidade_atual" value="0" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all font-mono" required>
            </div>

            {{-- Quantidade Mínima --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Quantidade Mínima (Gatilho de Alerta 🚨)</label>
                <input type="number" step="0.01" name="quantidade_minima" placeholder="Ex: 15.00" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all font-mono" required>
            </div>

            {{-- Limite Máximo Automatizado --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Limite Máximo Restritivo (Capacidade Física da Área)</label>
                <input type="number" step="0.01" name="limite_maximo" id="limite_maximo" placeholder="O teto será carregado com base na área definida acima" 
                    class="w-full px-4 py-3 border border-slate-200 bg-slate-100 rounded-xl font-black text-slate-500 text-sm outline-none font-mono" required readonly>
                <p class="text-[11px] text-slate-400 font-bold mt-2 uppercase tracking-wide">ℹ Cubagem calculada dinamicamente via módulo de parametrização de pátio (F_B07).</p>
            </div>

            {{-- Ações --}}
            <div class="md:col-span-2 flex justify-end gap-4 mt-6 border-t border-slate-100 pt-6">
                <button type="reset" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all active:scale-95 tracking-wider">
                    Limpar Form
                </button>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider">
                    💾 Salvar Insumo no Pátio
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