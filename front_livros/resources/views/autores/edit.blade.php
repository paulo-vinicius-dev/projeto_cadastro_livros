<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
</head>
<body>
    <h1>Editar Autor</h1>
    <form action="{{ route('autores.update', $autor['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $autor['nome'] }}" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
