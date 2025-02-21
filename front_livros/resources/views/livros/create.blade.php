<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Livro</title>
</head>
<body>
    <h1>Criar Livro</h1>
    <form action="{{ route('livros.store') }}" method="POST">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" required><br><br>

        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" name="ano_publicacao" id="ano_publicacao" required><br><br>

        <label for="autores">Autores:</label>
        <select name="autores[]" id="autores" multiple required>
            @foreach($autores as $autor)
                <option value="{{ $autor['id'] }}">{{ $autor['nome'] }}</option>
            @endforeach
        </select><br><br>

        <label for="categorias">Categorias:</label>
        <select name="categorias[]" id="categorias" multiple required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria['id'] }}">{{ $categoria['nome'] }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
