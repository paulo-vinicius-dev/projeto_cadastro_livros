<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Categoria</title>
</head>
<body>
    <h1>Criar Categoria</h1>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
