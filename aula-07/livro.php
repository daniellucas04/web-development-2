<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recebe dados</title>
</head>
<body>
    <form action="salva_livro.php">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo"><br>
        <label for="idioma">Idioma:</label>
        <input type="text" name="idioma"><br>
        <label for="quantidade_paginas">Quantidade de páginas:</label>
        <input type="text" name="quantidade_paginas"><br>
        <label for="editora">Editora:</label>
        <input type="text" name="editora"><br>
        <label for="data_publicacao">Data publicação:</label>
        <input type="date" name="data_publicacao"><br>
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn"><br>
        <input type="submit">
    </form>
</body>
</html>