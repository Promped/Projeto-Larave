@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-3xl mx-auto border-t-8 border-blue-600">
        
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('usuarios.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Parametrizar Usuário</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Criação de perfis de segurança para operação das empresas ou gestão master</p>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl mb-6 text-xs font-bold uppercase tracking-wide">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário --}}
        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nome --}}
                <div>
                    <label for="name" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nome Completo</label>
                    <input id="name" name="name" value="{{ old('name') }}" type="text" placeholder="EX: JOÃO DA SILVA" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase" required>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">E-mail Corporativo (Login)</label>
                    <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="nome@empresa.com" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Nível de Acesso --}}
                <div>
                    <label for="role" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Nível de Acesso</label>
                    <select id="role" name="role" onchange="toggleEmpresaField()"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all cursor-pointer" required>
                        <option value="operador" {{ old('role') == 'operador' ? 'selected' : '' }}>🏢 OPERADOR LOCAL (EMPRESA)</option>
                        <option value="master" {{ old('role') == 'master' ? 'selected' : '' }}>⚙️ ADMINISTRADOR MASTER</option>
                    </select>
                </div>

                {{-- Empresa Vinculada --}}
                <div>
                    <label id="empresa_label" for="empresa" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Empresa Vinculada</label>
                    <input id="empresa" name="empresa" value="{{ old('empresa') }}" type="text" placeholder="EX: CONSTRUTORA ALFA LTDA" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-6">
                {{-- Senha --}}
                <div>
                    <label for="password" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Senha de Acesso</label>
                    <input id="password" name="password" type="password" placeholder="Mínimo 6 caracteres" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                </div>

                {{-- Confirmar Senha --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Confirmar Senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Repita a senha" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all" required>
                </div>
            </div>

            {{-- Botões operacionais --}}
            <div class="flex justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('usuarios.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all text-center tracking-wider">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider">
                    Salvar Credencial
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleEmpresaField() {
        const roleSelect = document.getElementById('role');
        const empresaInput = document.getElementById('empresa');
        
        if (roleSelect.value === 'master') {
            empresaInput.value = 'SISTEMA CENTRAL';
            empresaInput.readOnly = true;
            empresaInput.classList.add('bg-slate-100', 'text-slate-400');
        } else {
            if(empresaInput.value === 'SISTEMA CENTRAL') empresaInput.value = '';
            empresaInput.readOnly = false;
            empresaInput.classList.remove('bg-slate-100', 'text-slate-400');
        }
    }
    // Executa na carga da página para preservar estados antigos (Old inputs)
    window.onload = toggleEmpresaField;
</script>
@endsection