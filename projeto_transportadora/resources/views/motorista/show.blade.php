@extends('layout')

@section('content')

<h1>Consultar Motorista</h1>

<div class="mb-3">
    <label class="form-label">Nome</label>
    <input value="{{ $motorista->nome }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">CPF</label>
    <input value="{{ $motorista->cpf }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">CNH</label>
    <input value="{{ $motorista->cnh }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">Telefone</label>
    <input value="{{ $motorista->telefone }}" type="text" class="form-control" disabled>
</div>

<form method="post" action="{{ route('motoristas.destroy', $motorista->id) }}">
    @csrf
    @method('DELETE')
    <p>Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Sim</button>
    <a href="{{ route('motoristas.index') }}" class="btn btn-secondary">Voltar</a>
</form>

@endsection