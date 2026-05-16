@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">🚚</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Transportadoras Homologadas</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Gerenciamento de parceiros logísticos e frotas externas</p>
                </div>
            </div>
            <a href="{{ route('transportadoras.create') }}" 
               class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Nova Transportadora
            </a>
        </div>

        @if(session('sucesso'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('sucesso') }}
            </div>
        @endif
        
        @if(session('erro'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl text-red-800 font-bold text-xs uppercase tracking-wider">
                ⚠️ {{ session('erro') }}
            </div>
        @endif

        @if($transportadoras->isEmpty())
            <div class="text-center py-16 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <span class="text-5xl block mb-4">🚛</span>
                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Nenhuma transportadora cadastrada no sistema.</p>
            </div>
        @else
            <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-900 text-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">ID</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Razão Social</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">CNPJ</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Contato</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                        @foreach($transportadoras as $transportadora)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400 font-black">#{{ str_pad($transportadora->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-extrabold text-slate-800">{{ $transportadora->razao_social }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-slate-100 px-3 py-1.5 rounded-xl text-xs font-black tracking-wide text-slate-600 border border-slate-200/60">
                                    {{ $transportadora->cnpj }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs space-y-0.5">
                                <div class="text-slate-800 font-extrabold">📞 {{ $transportadora->telefone }}</div>
                                <div class="text-slate-400 font-medium lowercase">{{ $transportadora->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('transportadoras.edit', $transportadora->id) }}" 
                                       class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black uppercase hover:bg-blue-100 transition-all">
                                        Editar
                                    </a>
                                    <a href="{{ route('transportadoras.show', $transportadora->id) }}" 
                                       class="px-4 py-2 bg-red-50 text-red-600 rounded-xl font-black uppercase hover:bg-red-100 transition-all">
                                        Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection