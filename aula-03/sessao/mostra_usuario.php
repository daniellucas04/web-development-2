<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sessão</title>
</head>
<body>
    <?php
    session_start();
    $pg_atual = 'mostra_usuario';
    include 'navbar.php';
    ?>
    <div class="container-fluid">
        <?php  
        if(isset($_SESSION['nome'])) {
            echo "Nome: {$_SESSION['nome']}";
        } else {
            echo "<a href='primeira.php'>Iniciar sessão</a>";
        }
        ?>
    </div>
</body>
</html>