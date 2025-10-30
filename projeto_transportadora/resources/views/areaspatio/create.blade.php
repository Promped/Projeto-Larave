@extends('layout')

@section('content')

<h1>Áreas patio</h1>
<form method="post" action="/areaspatio">
    @CSRF
    <div class="mb-3">
        <label for="nome" class="form-label">Informe a descrição:</label>
        <input type="text" id="descricao" name="descricao" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection