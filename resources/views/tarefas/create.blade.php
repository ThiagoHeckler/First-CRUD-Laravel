<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
<h1>Criar Nova Tarefa</h1>

<form action="{{ route('tarefas.store') }}" method="POST">
    @csrf
    <input type="text" name="titulo" placeholder="Título da tarefa" required>
    <button type="submit">Salvar</button>
</form>
</div>
</body>
</html>