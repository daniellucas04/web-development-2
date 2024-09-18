<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mostrar produtos</title>
</head>
<body>
    <?php 
    session_start();
    if(empty($_SESSION['produto'])) {
        header('Location: novo.php');
    }
    ?>
    <?php 
    $pgAtual = 'mostra';
    include 'menu.php';
    ?>
    <div class="container mt-3">
        <div class="row gap-4 d-flex align-items-center justify-content-center">
            <?php
            include 'produto.php';

            foreach($_SESSION['produto'] as $produto) {
                $produtoCadastrado = unserialize($produto);
                echo $produtoCadastrado->exibirInformacoes();
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>