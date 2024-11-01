<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastrar administração</title>
</head>
<body>
    <?php 
    $id = $_GET['id'] ?? null;
    session_start();
    if ($_SESSION['tipo_usuario'] == 'medico' OR $_SESSION['tipo_usuario'] == 'enfermeiro') {
    ?>
    <div class="container mt-5">
        <h1>Cadastrar administração</h1>
        <?php
        include "conexao.php";

        $error = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $sql = "SELECT id FROM paciente WHERE id_paciente = :id_paciente";
            $select = $conn->prepare($sql);
            $dados = $select->execute(['id_paciente' => $data['id_paciente']]);
            
            if (!$dados) {
                echo "<div class='alert alert-danger'>Erro ao encontrar este paciente. <a href='cadastrar_paciente.php'>Cadastre ele aqui</a>!</div>";
                $error = true;
            }

            if (!$error) {
                try {
                    $sql = "INSERT INTO receita (id_paciente, nome_medicamento, dose) values (:id_paciente, :nome_medicamento, :dose)";
                    $insert = $conn->prepare($sql);
                    
                    if ($insert->execute(['id_paciente' => $data['id_paciente'], 'nome_medicamento' => $data['nome_medicamento'], 'dose' => $data['dose']])) {
                        echo "<div class='alert alert-success'>Receita cadastrada com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar a Receita!</div>";
                    }
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
        }
        ?>
        <form method="post">
            <?php 
            $sql = "SELECT p.id, r.nome_medicamento, r.data_administracao, r.dose FROM receita AS r INNER JOIN paciente AS p ON r.id_paciente = p.id WHERE r.id = :id";
            $selectReceita = $conn->prepare($sql);
            $selectReceita->execute(['id' => $id]);
            $dados = $selectReceita->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="row">
                <div class="col">
                    <select class="form-select form-select-lg mt-2" name="id_paciente" disabled>
                        <option selected disabled>Selecione um paciente</option>
                        <?php
                        $sql = "SELECT id, nome FROM paciente";
                        $select = $conn->prepare($sql);
                        $select->execute();
    
                        while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $linha['id']; ?>" <?= ($linha['id'] == $dados['id']) ? 'selected' : null; ?>> <?= $linha['nome'] ?> </option>
                        <?php endwhile;?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="nome_medicamento" value="<?= $dados['nome_medicamento']; ?>" placeholder="Nome do medicamento" id="nome_medicamento">
                        <label for="nome_medicamento">Nome do medicamento</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="dose" value="<?= $dados['dose']; ?>" placeholder="Dose" id="dose">
                        <label for="dose">Dose</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="datetime-local" name="data_registro" placeholder="Data do registro" id="data_registro">
                        <label for="data_registro">Data do registro</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary mt-2">Cadastrar</button>
        </form>
    </div>
    <?php 
    } else {
      header('Location: login_medico.php');  
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>