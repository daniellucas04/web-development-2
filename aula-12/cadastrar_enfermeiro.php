<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="api/scripts/enfermeiro.js"></script>
    <title>Cadastrar enfermeiro</title>
</head>
<body>
    <?php
    $pgAtual = 'cadastrar_enfermeiro';
    include 'navbar.php';

    if ($_SESSION['tipo_usuario'] == 'Admin') {
    ?>
        <div class="container mt-5">
            <h3>Cadastrar enfermeiro</h3>

            <div id="result"></div>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="nome" placeholder="Nome" id="nome" required>
                        <label for="nome">Nome</label>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="coren" placeholder="COREN" id="coren" required>
                        <label for="coren">COREN</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-2">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="usuario" placeholder="Usuário" id="usuario" required>
                        <label for="usuario">Usuário</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-floating">
                        <input required class="form-control" type="password" name="senha" placeholder="Senha" id="senha" required>
                        <label for="senha">Senha</label>
                    </div>
                </div>
            </div>
            <button id="create" class="btn btn-primary mt-2">Cadastrar</button>
        </div>
    <?php
    } else {
        header('Location: login_medico.php');
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>