@extends('layout')

@section('content')

<h1>Alterar Transportadora</h1>
<form method="post" action="{{ route('transportadoras.update', $transportadora->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="razao_social" class="form-label">Razão Social</label>
        <input value="{{ $transportadora->razao_social ?? $transportadora->descricao ?? '' }}" type="text" id="razao_social" name="razao_social" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input value="{{ $transportadora->cnpj ?? '' }}" type="text" id="cnpj" name="cnpj" class="form-control">
    </div>
    <div class="mb-3">
        <label for="endereco" class="form-label">Endereço</label>
        <input value="{{ $transportadora->endereco ?? '' }}" type="text" id="endereco" name="endereco" class="form-control">
    </div>
    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input value="{{ $transportadora->telefone ?? '' }}" type="text" id="telefone" name="telefone" class="form-control">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input value="{{ $transportadora->email ?? '' }}" type="email" id="email" name="email" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection