<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Aula 08</title>
</head>
<body>
    <?php 
    $pgAtual = 'livros';
    include('navbar.php');
    ?>
    <div class="container mt-4">
        <div class="row">
            <?php
            // conexao
            $servidor = 'localhost';
            $banco = 'livraria';
            $usuario = 'root';
            $senha = '';

            $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

            $codigoSQL = "SELECT `id`, `titulo`, `idioma`, `quantidade_paginas`, `editora`, `data_publicacao`, `isbn` FROM `livro`";
            $comando = $conexao->prepare($codigoSQL);
            $resultado = $comando->execute();

            if($resultado) {
                while($linha = $comando->fetch()):
                    $date = date_create($linha['data_publicacao']);
                    $linha['data_publicacao'] = date_format($date, 'd/m/Y');
            ?>
                <div class="col">
                    <div class="card mb-5" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $linha['titulo']; ?></h5>
                            <p class="card-text">Data de publicação: <?= $linha['data_publicacao']; ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Idioma: <?= $linha['idioma'] ?></li>
                            <li class="list-group-item">Editora: <?= $linha['editora']; ?></li>
                            <li class="list-group-item">Quantidade de páginas: <?= $linha['quantidade_paginas']; ?></li>
                            <li class="list-group-item">ISBN: <?= $linha['isbn']; ?></li>
                        </ul>
                        <div class="card-body">
                            <a class="btn btn-outline-danger" href="apaga.php?id=<?= $linha['id']; ?>&page=livro">Apagar</a>
                            <a class="btn btn-outline-primary" href="atualiza_livro.php?id=<?= $linha['id']; ?>">Editar</a>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            } 
            $conexao = null;
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </body>
    </div>
</html>