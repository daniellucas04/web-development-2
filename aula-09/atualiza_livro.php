<?php 
$servidor = 'localhost';
$banco = 'livraria';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

if (count($_GET) > 1) {
    $codigoSQL = "UPDATE livro SET titulo = :titulo, idioma = :idioma, quantidade_paginas = :quantidade_paginas, editora = :editora, isbn = :isbn, data_publicacao = :data_publicacao WHERE id = :id";
    
    try {
        $resultado = $conexao->prepare($codigoSQL);
        $resultado = $resultado->execute(['titulo' => $_GET['titulo'], 'idioma' => $_GET['idioma'], 'quantidade_paginas' => $_GET['quantidade_paginas'], 'editora' => $_GET['editora'], 'isbn' => $_GET['isbn'], 'data_publicacao' => $_GET['data_publicacao'], 'id' => $_GET['id']]);
    
        if ($resultado) {
            echo 'Dados atulizados com sucesso!';    
        } else {
            echo 'Erro ao atualizar os dados!';
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
    
    $conexao = null;
    header("Location: mostra_livros.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Atualizar livro</title>
</head>
<body>
    <?php 
    $pgAtual = 'livros';
    include('navbar.php');
    ?>
    <div class="container mt-4">
        <?php
        $comando = $conexao->prepare("SELECT * FROM livro WHERE id = {$_GET['id']}");
        $resultado = $comando->execute();

        if ($resultado){
            if($linha = $comando->fetch(PDO::FETCH_ASSOC)):
        ?>
            <form>
                <label for="titulo">Título</label>
                <input class="form-control" type="text" value="<?= $linha['titulo'] ?>" name="titulo" id="titulo">
                <label for="editora">Editora</label>
                <input class="form-control" type="text" value="<?= $linha['editora'] ?>" name="editora" id="editora">
                <label for="quantidade_paginas">Quantidade de páginas</label>
                <input class="form-control" type="text" value="<?= $linha['quantidade_paginas'] ?>" name="quantidade_paginas" id="quantidade_paginas">
                <label for="idioma">Idioma</label>
                <input class="form-control" type="text" value="<?= $linha['idioma'] ?>" name="idioma" id="idioma">
                <label for="isbn">ISBN</label>
                <input class="form-control" type="text" value="<?= $linha['isbn'] ?>" name="isbn" id="isbn">
                <label for="data_publicacao">Data de publicação</label>
                <input class="form-control" type="date" value="<?= explode(' ', $linha['data_publicacao'])[0]; ?>" name="data_publicacao" id="data_publicacao">
                <input type="hidden" value="<?= $linha['id'] ?>" name="id">
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit">Editar</button>
                </div>
            </form>
        <?php
            endif;
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>