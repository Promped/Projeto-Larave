@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600">
        
        {{-- Título do Formulário --}}
        <div class="mb-8 border-b border-slate-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📦</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Novo Material</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Cadastro de insumos e tipos de cargas para a operação</p>
                </div>
            </div>
        </div>

        <form action="{{ route('cargas.store') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Nome / Tipo --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nome do Material / Tipo de Carga*</label>
                <input type="text" name="tipo" placeholder="Ex: Madeira Pinus" required 
                       class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
            </div>
            
            {{-- Unidade de Medida --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Unidade de Medida Padrão</label>
                <select name="unidade_medida" required
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all cursor-pointer">
                    <option value="TON">Toneladas (ton)</option>
                    <option value="KG">Quilos (kg)</option>
                    <option value="M3">Metros Cúbicos (m³)</option>
                    <option value="UN">Unidades (un)</option>
                </select>
            </div>

            {{-- Descrição --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Descrição Técnica / Notas</label>
                <textarea name="descricao" rows="3" placeholder="Informações adicionais sobre o manuseio, empilhamento ou armazenamento..." 
                          class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all"></textarea>
            </div>

            {{-- Ações --}}
            <div class="mt-10 flex justify-end items-center gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('cargas.index') }}" 
                   class="px-5 py-2.5 text-xs font-black text-slate-400 uppercase tracking-wider hover:text-slate-600 transition-colors">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95">
                    Salvar Cadastro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection