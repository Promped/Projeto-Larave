@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-3xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho Integrado --}}
        <div class="mb-8 border-b border-slate-100 pb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Conferência Documental e Física</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Validação final de segurança na portaria antes da evasão</p>
                </div>
                <span class="text-4xl text-slate-300">📋</span>
            </div>
        </div>

        {{-- Formulário batendo certinho com a sua action e ID da movimentação --}}
        <form action="{{ route('liberacao.store', $movimentacao->id) }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Painel de Resumo do Fluxo --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100 shadow-inner">
                <div>
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Veículo / Modelo</span>
                    <p class="text-base font-black text-slate-800 tracking-tight">
                        <span class="font-mono bg-white border px-2 py-0.5 rounded-lg text-sm mr-2">{{ strtoupper($movimentacao->agendamento->veiculo->placa ?? '') }}</span>
                        {{ $movimentacao->agendamento->veiculo->modelo ?? 'N/A' }}
                    </p>
                </div>
                <div>
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Condutor / Motorista</span>
                    <p class="text-base font-black text-slate-700 uppercase">{{ $movimentacao->agendamento->motorista->nome ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Área do Check-list Obrigatório --}}
            <div class="space-y-4 pt-4">
                <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest">Check-list de Segurança em Pátio</h3>
                
                {{-- Item 1: Documental --}}
                <label class="group flex items-start p-4 border border-slate-200 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50/40 transition-all cursor-pointer shadow-sm bg-white">
                    <input type="checkbox" name="check_documentos" value="1" required 
                           class="mt-1 w-5 h-5 rounded-md border-slate-300 text-emerald-600 focus:ring-emerald-500 transition-all cursor-pointer">
                    <div class="ml-4">
                        <span class="block font-black text-slate-800 text-sm group-hover:text-emerald-800 transition-colors">Conferência Documental Realizada</span>
                        <span class="text-xs text-slate-400 font-medium font-sans">NF-e, CNH do condutor e Ordem de Saída validados fisicamente e sistemicamente.</span>
                    </div>
                </label>

                {{-- Item 2: Físico --}}
                <label class="group flex items-start p-4 border border-slate-200 rounded-2xl hover:border-emerald-500 hover:bg-emerald-50/40 transition-all cursor-pointer shadow-sm bg-white">
                    <input type="checkbox" name="check_fisico" value="1" required 
                           class="mt-1 w-5 h-5 rounded-md border-slate-300 text-emerald-600 focus:ring-emerald-500 transition-all cursor-pointer">
                    <div class="ml-4">
                        <span class="block font-black text-slate-800 text-sm group-hover:text-emerald-800 transition-colors">Vistoria e Carga Concluídas</span>
                        <span class="text-xs text-slate-400 font-medium font-sans">Lacre da carga intacto, lona de proteção firme e veículo sem avarias aparentes de rodagem.</span>
                    </div>
                </label>
            </div>

            {{-- Observações Operacionais (Grava no request->observacoes) --}}
            <div class="pt-2">
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Observações Adicionais da Portaria</label>
                <textarea name="observacoes" rows="3" 
                          class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all"
                          placeholder="Ex: Lacre nº 0012345 verificado. Motorista portando EPI obrigatório."></textarea>
            </div>

            {{-- Botões de Decisão --}}
            <div class="mt-8 flex items-center gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('liberacao.index') }}" 
                   class="flex-1 text-center py-4 text-xs font-black text-slate-400 uppercase tracking-wider hover:text-slate-600 transition-colors">
                    Cancelar Triagem
                </a>
                <button type="submit" 
                        class="flex-[2] py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 tracking-widest text-center">
                    Autorizar Saída e Avançar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection