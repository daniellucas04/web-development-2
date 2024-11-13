<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="api/scripts/receita.js"></script>
    <title>Cadastrar receita</title>
</head>
<body>
    <?php 
    $pgAtual = 'cadastrar_receita';
    include 'navbar.php';
    include 'conexao.php';

    if ($_SESSION['tipo_usuario'] == 'Médico') {
    ?>
        <div class="container mt-5">
            <h3>Cadastrar receita</h3>

            <div id="result"></div>
            <div class="row">
                <div class="col">
                    <select class="form-select form-select-lg mt-2" name="id_paciente" id="id_paciente" required>
                        <option selected disabled>Selecione um paciente</option>
                        <?php
                        $sql = "SELECT id, nome FROM paciente";
                        $select = $conn->prepare($sql);
                        $select->execute();
    
                        while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $linha['id']; ?>"> <?= $linha['nome'] ?> </option>
                        <?php endwhile;?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="nome_medicamento" placeholder="Nome do medicamento" id="nome_medicamento">
                        <label for="nome_medicamento">Nome do medicamento</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="dose" placeholder="Dose" id="dose">
                        <label for="dose">Dose</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="datetime-local" name="data_administracao" placeholder="Data da administração" id="data_administracao">
                        <label for="data_administracao">Data da administração</label>
                    </div>
                </div>
            </div>
            <button id="create" class="btn btn-primary mt-2">Cadastrar</button>
        </div>
    <?php 
    } else {
        header('Location: login_medico.php');
        exit;
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>