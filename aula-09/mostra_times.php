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
    $pgAtual = 'times';
    include('navbar.php');
    ?>
    <div class="container mt-4">
       <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Pontos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // conexao
                $servidor = 'localhost';
                $banco = 'futebol';
                $usuario = 'root';
                $senha = '';

                $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

                $codigoSQL = "SELECT `id`, `nome`, `pontos` FROM `times` ORDER BY `pontos` DESC";
                $comando = $conexao->prepare($codigoSQL);
                $resultado = $comando->execute();

                if($resultado) {
                    while($linha = $comando->fetch()): 
                ?>
                    <tr>
                        <td><?= $linha['nome']; ?></td>
                        <td><?= $linha['pontos']; ?></td>
                        <td>
                            <a class="btn btn-outline-danger" href="apaga.php?id=<?= $linha['id']; ?>&page=time">Apagar</a>
                            <a class="btn btn-outline-primary" href="atualiza_time.php?id=<?= $linha['id']; ?>">Editar</a>
                        </td>
                    </tr>
                <?php 
                    endwhile; 
                }
                $conexao = null;
                ?>
            </tbody>
        </table>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>