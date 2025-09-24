@extends('layout')

@section('conteudo')

<h1>Nova Função de Motorista</h1>
<form method="post" action="/motorista">
    @CSRF
    <div class="mb-3">
        <label for="nome" class="form-label">Informe a descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection