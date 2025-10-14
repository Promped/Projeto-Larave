<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Sair</button>
    </form>
</body>
</html>
