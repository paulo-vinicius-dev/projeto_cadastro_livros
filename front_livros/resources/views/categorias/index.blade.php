<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1>Categorias</h1>
    <a href="{{ route('categorias.create') }}">Criar Nova Categoria</a>
    <ul>
        @foreach($categorias as $categoria)
            <li>
                {{ $categoria['nome'] }}
                <a href="{{ route('categorias.edit', $categoria['id']) }}">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
