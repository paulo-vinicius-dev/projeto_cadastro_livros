<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
</head>
<body>
    <h1>Autores</h1>
    <a href="{{ route('autores.create') }}">Criar Novo Autor</a>
    <ul>
        @foreach($autores as $autor)
            <li>
                {{ $autor['nome'] }}
                <a href="{{ route('autores.edit', $autor['id']) }}">Editar</a>
                <form action="{{ route('autores.destroy', $autor['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
