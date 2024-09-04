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
    $pg_atual = 'primeira';
    include 'navbar.php';
    ?>

    <div class="container-fluid">
        <form action="salva_usuario.php" method="post">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control"><br>

            <button class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>