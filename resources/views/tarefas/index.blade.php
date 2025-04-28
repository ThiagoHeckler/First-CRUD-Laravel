<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Tarefas</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    
<h1>Lista de Tarefas</h1>

<a href="{{ route('tarefas.create') }}">Criar Nova Tarefa</a>

<ul>
    @foreach($tarefas as $id => $tarefa)
        <li>
            {{ $tarefa['titulo'] }}
            <a href="{{ route('tarefas.edit', $id) }}">Editar</a>

            <form action="{{ route('tarefas.destroy', $id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir</button>
            </form>
        </li>
    @endforeach
</ul>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif
</div>
</body>
</html>