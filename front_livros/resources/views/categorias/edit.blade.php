<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
</head>
<body>
    <h1>Editar Categoria</h1>
    <form action="{{ route('categorias.update', $categoria['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="{{ $categoria['nome'] }}" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
