<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrar administração</title>
</head>
<body>
    <?php 
    $pgAtual = 'registrar_administracao';
    include 'navbar.php';

    $id = $_GET['id'] ?? null;
    if ($_SESSION['tipo_usuario'] == 'Enfermeiro') {
    ?>
    <div class="container mt-5">
        <h3>Registrar administração</h3>
        <?php
        include "conexao.php";

        $error = false;
        $dados = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $data['id_paciente'] = $id;

            $sql = "SELECT id FROM paciente WHERE id = :id";
            $select = $conn->prepare($sql);
            $dados = $select->execute(['id' => $data['id_paciente']]);
            
            if (!$dados) {
                echo "<div class='alert alert-danger'>Erro ao encontrar este paciente. <a href='cadastrar_paciente.php'>Cadastre ele aqui</a>!</div>";
                $error = true;
            }

            $dataAtual = new DateTime();
            $dataRegistro = new DateTime($data['data_registro']);
            if($dataRegistro > $dataAtual) {
                echo "<div class='alert alert-danger'>A data de registro da administração não pode ser maior que a data atual!</div>";
                $error = true;
            }

            if (!$error) {
                try {
                    $sql = "INSERT INTO administracao (id_receita, data_registro) VALUES (:id_receita, :data_registro)";
                    $insert = $conn->prepare($sql);
                    
                    if ($insert->execute(['id_receita' => $id, 'data_registro' => $data['data_registro']])) {
                        $sql = "UPDATE receita SET status = :status WHERE id = :id";
                        $update = $conn->prepare($sql);
                        
                        if ($update->execute(['status' => 'T', 'id' => $id])) {
                            echo "<div class='alert alert-success'>Administração cadastrada com sucesso!</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar a administração!</div>";
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
                            <option value="<?= $linha['id']; ?>" <?= ($linha['id'] == $dados['id']) ? 'selected' : null; ?>><?= $linha['nome'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="nome_medicamento" value="<?= $dados['nome_medicamento'] ?? null; ?>" placeholder="Nome do medicamento" id="nome_medicamento">
                        <label for="nome_medicamento">Nome do medicamento</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input required class="form-control" type="text" name="dose" value="<?= $dados['dose'] ?? null; ?>" placeholder="Dose" id="dose">
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
        exit();
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>