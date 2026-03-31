@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        {{-- Cabeçalho --}}
        <div class="bg-[#0046AD] p-8 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-black tracking-tighter uppercase italic">F_F05: Conferência Documental e Física</h2>
                    <p class="text-blue-100 opacity-80">Validação final antes da saída das docas</p>
                </div>
                <span class="text-5xl opacity-20">🚛</span>
            </div>
        </div>

        <form action="{{ route('liberacao.store', $movimentacao->id) }}" method="POST" class="p-8">
            @csrf
            
            {{-- Dados do Veículo --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Veículo / Placa</p>
                    <p class="text-lg font-bold text-gray-800">{{ $movimentacao->agendamento->veiculo->placa }} - {{ $movimentacao->agendamento->veiculo->modelo }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase mb-1">Motorista</p>
                    <p class="text-lg font-bold text-gray-800">{{ $movimentacao->agendamento->motorista->nome }}</p>
                </div>
            </div>

            {{-- Check-list de Segurança --}}
            <div class="space-y-4">
                <h3 class="font-black text-gray-700 uppercase text-sm tracking-widest mb-4">Check-list Obrigatório</h3>
                
                {{-- Item 1: Documentação --}}
                <label class="group flex items-center p-5 border-2 border-gray-100 rounded-2xl hover:border-[#00A859] hover:bg-green-50 transition-all cursor-pointer shadow-sm">
                    <input type="checkbox" name="check_documentos" value="1" required class="w-6 h-6 rounded-lg text-[#00A859] focus:ring-[#00A859]">
                    <div class="ml-4">
                        <span class="block font-bold text-gray-800 group-hover:text-green-700">Conferência Documental</span>
                        <span class="text-sm text-gray-500 italic">NF-e, CNH e Ordem de Saída validados no sistema.</span>
                    </div>
                </label>

                {{-- Item 2: Físico --}}
                <label class="group flex items-center p-5 border-2 border-gray-100 rounded-2xl hover:border-[#00A859] hover:bg-green-50 transition-all cursor-pointer shadow-sm">
                    <input type="checkbox" name="check_fisico" value="1" required class="w-6 h-6 rounded-lg text-[#00A859] focus:ring-[#00A859]">
                    <div class="ml-4">
                        <span class="block font-bold text-gray-800 group-hover:text-green-700">Conferência Física</span>
                        <span class="text-sm text-gray-500 italic">Lacre da carga intacto e veículo em condições de rodagem.</span>
                    </div>
                </label>
            </div>

            {{-- Observações --}}
            <div class="mt-8">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Observações Adicionais (Opcional)</label>
                <textarea name="observacoes" rows="3" class="w-full rounded-xl border-gray-200 focus:border-[#0046AD] focus:ring-0 text-sm" placeholder="Ex: Lacre nº 12345 conferido."></textarea>
            </div>

            {{-- Botões --}}
            <div class="mt-10 flex gap-4">
                <a href="{{ route('liberacao.index') }}" class="flex-1 text-center py-4 rounded-xl font-bold text-gray-400 hover:bg-gray-100 transition-all">
                    CANCELAR
                </a>
                <button type="submit" class="flex-[2] bg-[#00A859] hover:bg-[#008f4c] text-white py-4 rounded-xl font-black text-lg shadow-xl shadow-green-200 transition-all transform hover:-translate-y-1 uppercase tracking-tighter">
                    AUTORIZAR SAÍDA E GERAR TICKET
                </button>
            </div>
        </form>
    </div>
</div>
@endsection