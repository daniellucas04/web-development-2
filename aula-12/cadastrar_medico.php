<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="api/scripts/medico.js"></script>
    <title>Cadastrar médico</title>
</head>
<body>
    <?php
    $pgAtual = 'cadastrar_medico';
    include 'navbar.php';

    if ($_SESSION['tipo_usuario'] == 'Admin') {
    ?>
    <div class="container mt-5">
        <h3>Cadastrar médico</h3>
        <div id="result"></div>
        <div class="row">
            <div class="col-4">
                <div class="form-floating">
                    <input required class="form-control" type="text" name="nome" placeholder="Nome" id="nome">
                    <label for="nome">Nome</label>
                </div>
            </div>

            <div class="col-4">
                <div class="form-floating">
                    <input required class="form-control" type="text" name="especialidade" placeholder="Especialidade" id="especialidade">
                    <label for="especialidade">Especialidade</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating">
                    <input required class="form-control" type="text" name="crm" placeholder="CRM" id="crm">
                    <label for="crm">CRM</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <div class="form-floating">
                    <input required class="form-control" type="text" name="usuario" placeholder="Usuário" id="usuario">
                    <label for="usuario">Usuário</label>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="form-floating">
                    <input required class="form-control" type="password" name="senha" placeholder="Senha" id="senha">
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