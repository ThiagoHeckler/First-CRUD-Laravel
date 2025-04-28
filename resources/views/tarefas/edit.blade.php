<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
<h1>Editar Tarefa</h1>

<form action="{{ route('tarefas.update', $id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="titulo" value="{{ $tarefa['titulo'] }}" required>
    <button type="submit">Atualizar</button>
</form>
</div>
</body>
</html>
