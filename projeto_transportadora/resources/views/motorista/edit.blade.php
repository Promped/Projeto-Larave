@extends('layout')

@section('content')

<h1>Alterar Motorista</h1>
<form method="post" action="{{ route('motoristas.update', $motorista->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input value="{{ $motorista->nome }}" type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input value="{{ $motorista->cpf }}" type="text" id="cpf" name="cpf" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cnh" class="form-label">CNH</label>
        <input value="{{ $motorista->cnh }}" type="text" id="cnh" name="cnh" class="form-control">
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input value="{{ $motorista->telefone }}" type="text" id="telefone" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label for="transportadora_id" class="form-label">Transportadora</label>
        <select id="transportadora_id" name="transportadora_id" class="form-control">
            <option value="">-- Escolha --</option>
            @foreach(App\Models\Transportadora::all() as $t)
                <option value="{{ $t->id }}" {{ $motorista->transportadora_id == $t->id ? 'selected' : '' }}>{{ $t->razao_social ?? $t->descricao }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection