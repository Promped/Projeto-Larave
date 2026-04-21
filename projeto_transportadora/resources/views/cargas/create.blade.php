@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-gray-50 min-h-screen">
    <div class="bg-white shadow-2xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600 animate-fade-in">
        
        <div class="flex items-center gap-4 mb-8">
            <span class="text-4xl">📦</span>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Novo Material</h2>
                <p class="text-xs font-bold text-gray-400 uppercase">Cadastro de Tipos de Carga para Operação</p>
            </div>
        </div>

        <form action="{{ route('cargas.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-[10px] font-black text-blue-600 uppercase mb-2 tracking-widest">Nome do Material / Tipo de Carga*</label>
                <input type="text" name="tipo" placeholder="Ex: Madeira Pinus" required 
                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner">
            </div>
            
            <div>
                <label class="block text-[10px] font-black text-blue-600 uppercase mb-2 tracking-widest">Unidade de Medida Padrão</label>
                <select name="unidade_medida" class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all cursor-pointer">
                    <option value="TON">Toneladas (ton)</option>
                    <option value="KG">Quilos (kg)</option>
                    <option value="M3">Metros Cúbicos (m³)</option>
                    <option value="UN">Unidades (un)</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black text-blue-600 uppercase mb-2 tracking-widest">Descrição Técnica</label>
                <textarea name="descricao" rows="3" placeholder="Informações adicionais sobre o manuseio ou armazenamento..." 
                          class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl py-4 px-5 text-slate-800 font-bold focus:border-blue-500 focus:bg-white outline-none transition-all shadow-inner"></textarea>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                <a href="{{ route('cargas.index') }}" 
                   class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-xs uppercase hover:bg-slate-200 transition-all">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase hover:bg-blue-700 shadow-lg shadow-blue-200 active:scale-95 transition-all">
                    Salvar Cadastro
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes fade-in { 
        from { opacity: 0; transform: translateY(10px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
    .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
</style>
@endsection