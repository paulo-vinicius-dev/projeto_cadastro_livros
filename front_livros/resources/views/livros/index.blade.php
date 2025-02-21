<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
</head>
<body>
    <h1>Livros</h1>
    <a href="{{ route('livros.create') }}">Criar Novo Livro</a>
    <ul>
        @foreach($livros as $livro)
            <li>
                {{ $livro['titulo'] }} - {{ $livro['isbn'] }} - {{ $livro['ano_publicacao'] }}
                <a href="{{ route('livros.edit', $livro['id']) }}">Editar</a>
                <form action="{{ route('livros.destroy', $livro['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
