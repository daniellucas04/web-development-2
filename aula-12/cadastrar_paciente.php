<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="api/scripts/paciente.js"></script>
    <title>Cadastrar paciente</title>
</head>
<body>
    <?php 
    $pgAtual = 'cadastrar_paciente';
    include 'navbar.php';

    if ($_SESSION['tipo_usuario'] == 'Médico' OR $_SESSION['tipo_usuario'] == 'Enfermeiro') {
    ?>
        <div class="container mt-5">
            <h3>Cadastrar paciente</h3>

            <div id="result"></div>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="nome" placeholder="Nome" id="nome">
                        <label for="nome">Nome</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="leito" placeholder="Leito" id="leito">
                        <label for="leito">Leito</label>
                    </div>
                </div>
            </div>
            <button id="create" class="btn btn-primary mt-2">Cadastrar</button>
        </div>
    <?php 
    } else {
        header('Location: login_medico.php');
        exit();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>