@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-3xl mx-auto border-t-8 border-blue-600">
        
        {{-- Header integrado --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('funcaovisitantes.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Nova Função de Visitante</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Configuração de parâmetros de entrada e agrupamento de credenciais na portaria</p>
            </div>
        </div>

        {{-- Erros de Validação Laravel --}}
        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl mb-6 text-xs font-bold uppercase tracking-wide">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('funcaovisitantes.store') }}" class="space-y-6">
            @csrf
            
            {{-- Descrição --}}
            <div>
                <label for="descricao" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Descrição / Tipo de Identificação</label>
                <input id="descricao" name="descricao" value="{{ old('descricao') }}" type="text" placeholder="Ex: Prestador Terceirizado, Fiscal do Trabalho, Direção..." 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase" required>
            </div>

            {{-- Empresa --}}
            <div>
                <label for="empresa" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Empresa Solicitante</label>
                <input id="empresa" name="empresa" value="{{ old('empresa') }}" type="text" placeholder="Ex: Construtora Alfa LTDA, Terceirizados Sul..." 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Função --}}
                <div>
                    <label for="funcao" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Atribuição / Cargo</label>
                    <input id="funcao" name="funcao" value="{{ old('funcao') }}" type="text" placeholder="Ex: Eletricista, Auditor, Engenheiro..." 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
                </div>
                
                {{-- Período --}}
                <div>
                    <label for="periodo" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Período de Acesso Permitido</label>
                    <input id="periodo" name="periodo" value="{{ old('periodo') }}" type="text" placeholder="Ex: Comercial, Noturno, 08:00 às 12:00" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
                </div>
            </div>

            {{-- Botões operacionais --}}
            <div class="flex justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('funcaovisitantes.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all text-center tracking-wider">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider">
                    Salvar Parâmetros
                </button>
            </div>
        </form>
    </div>
</div>
@endsection