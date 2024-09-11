<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mostra idade</title>
</head>
<body style="margin: 0; padding: 0;">
    <?php 
    $pg_atual = 'mostra_idade';
    include "menu.php"; 
    ?>

    <div class="container mt-4">
        <?php
        session_start();

        include 'aluno.php';

        if(isset($_SESSION['aluno'])) {
            $aluno = unserialize($_SESSION['aluno']);
            echo  "<h1>{$aluno->getNome()}, {$aluno->idade()}</h1>";
        } else {
            header('Location: formulario.php');
        }
        ?>
    </div>
</body>
</html>