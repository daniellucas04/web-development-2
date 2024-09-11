<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mostra</title>
</head>
<body style="margin: 0; padding: 0;">
    <?php 
    $pg_atual = 'mostra';
    include "menu.php"; 
    ?>

    <div class="container mt-4">
        <?php
        session_start();

        include 'aluno.php';

        if(isset($_SESSION['aluno'])):
            $aluno = unserialize($_SESSION['aluno']);
        ?>
        <div class="col d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title text-center"><?= $aluno->getNome(); ?></h3>
                    <p class="card-text">
                        <ul class="list-group">
                            <li class="list-group-item">Data nascimento: <?= Aluno::formatDateBR($aluno->getDataNascimento()) ?></li>
                            <li class="list-group-item">Matricula: <?= $aluno->getMatricula() ?></li>
                            <li class="list-group-item">Curso: <?= $aluno->getCurso() ?></li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <?php
        else: 
            header('Location: formulario.php');
        endif;
        ?>
    </div>
</body>
</html>