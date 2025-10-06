@extends('layout')

@section('conteudo')

<h1>Nova Transportadora</h1>
<form method="POST" action="{{ route('transportadora.store') }}">
    @csrf
    <div class="mb-3">
        <label for="descricao" class="form-label">Informe a descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection
