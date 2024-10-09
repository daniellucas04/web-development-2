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
    $pgAtual = 'produtos';
    include('navbar.php');
    ?>
    <div class="container mt-4">
        <div class="row">
            <?php
            // conexao
            $servidor = 'localhost';
            $banco = 'loja';
            $usuario = 'root';
            $senha = '';

            $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

            $codigoSQL = "SELECT `id`,  `nome`, `preco`, `descricao`, `foto_url` FROM `produtos`";
            $comando = $conexao->prepare($codigoSQL);
            $resultado = $comando->execute();

            if($resultado) {
                while($linha = $comando->fetch()):
            ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= $linha['foto_url']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $linha['nome']; ?></h5>
                            <p class="card-text"><?= $linha['descricao']; ?></p>
                            <span class="d-flex justify-content-between">
                                <a class="btn btn-outline-danger" href="apaga.php?id=<?= $linha['id']; ?>&page=produto">Apagar</a>
                                <a class="btn btn-success" href="#">R$ <?= $linha['preco']; ?></a>
                            </span>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            }
            $conexao = null;
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>