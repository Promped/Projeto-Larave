@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-blue-600">
        
        {{-- Título e Identificação do Registro --}}
        <div class="mb-8 border-b border-slate-100 pb-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📝</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Editar Material</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Modificando dados cadastrais de: <span class="text-blue-600">{{ $carga->tipo }}</span></p>
                </div>
            </div>
        </div>

        {{-- Formulário de Atualização --}}
        <form action="{{ route('cargas.update', $carga->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            {{-- Campo: Nome / Tipo de Carga --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nome do Material / Tipo de Carga*</label>
                <input type="text" name="tipo" value="{{ old('tipo', $carga->tipo) }}" required 
                       class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">
            </div>
            
            {{-- Campo: Unidade de Medida (Trazendo a opção salva selecionada) --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Unidade de Medida Padrão</label>
                <select name="unidade_medida" required
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all cursor-pointer">
                    <option value="TON" {{ strtolower($carga->unidade_medida) == 'ton' ? 'selected' : '' }}>Toneladas (ton)</option>
                    <option value="KG" {{ strtolower($carga->unidade_medida) == 'kg' ? 'selected' : '' }}>Quilos (kg)</option>
                    <option value="M3" {{ strtolower($carga->unidade_medida) == 'm3' ? 'selected' : '' }}>Metros Cúbicos (m³)</option>
                    <option value="UN" {{ strtolower($carga->unidade_medida) == 'un' ? 'selected' : '' }}>Unidades (un)</option>
                </select>
            </div>

            {{-- Campo: Descrição Técnica --}}
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Descrição Técnica / Notas</label>
                <textarea name="descricao" rows="3" placeholder="Informações sobre manuseio ou restrições..."
                          class="block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 transition-all">{{ old('descricao', $carga->descricao) }}</textarea>
            </div>

            {{-- Botões de Controle --}}
            <div class="mt-10 flex justify-end items-center gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('cargas.index') }}" 
                   class="px-5 py-2.5 text-xs font-black text-slate-400 uppercase tracking-wider hover:text-slate-600 transition-colors">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-blue-100 transition-all active:scale-95">
                    Atualizar Dados
                </button>
            </div>
        </form>
    </div>
</div>
@endsection