@extends('layout')

@section('content')

<h1>Consultar Transportadora</h1>

<div class="mb-3">
    <label class="form-label">Razão Social</label>
    <input value="{{ $transportadora->razao_social ?? $transportadora->descricao ?? '' }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">CNPJ</label>
    <input value="{{ $transportadora->cnpj ?? '' }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">Endereço</label>
    <input value="{{ $transportadora->endereco ?? '' }}" type="text" class="form-control" disabled>
</div>
<div class="mb-3">
    <label class="form-label">Telefone</label>
    <input value="{{ $transportadora->telefone ?? '' }}" type="text" class="form-control" disabled>
</div>
<form method="post" action="{{ route('transportadoras.destroy', $transportadora->id) }}">
    @csrf
    @method('DELETE')
    <p>Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Sim</button>
    <a href="{{ route('transportadoras.index') }}" class="btn btn-secondary">Voltar</a>
</form>

@endsection