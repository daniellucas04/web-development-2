<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <?php 
            include "conexao.php";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                try {
                    $sql = "INSERT INTO enfermeiro (nome, coren, usuario, senha) values (:nome, :coren, :usuario, :senha)";
                    $insert = $conn->prepare($sql);
                    
                    if ($insert->execute(['nome' => $data['nome'], 'coren' => $data['coren'], 'usuario' => $data['usuario'], 'senha' => $data['senha']])) {
                        echo "<div class='alert alert-success'>Enfermeiro cadastrado com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar o enfermeiro!</div>";
                    }
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
            ?>
            <form method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating">
                            <input required class="form-control" type="text" name="nome" placeholder="Nome" id="nome">
                            <label for="nome">Nome</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <input required class="form-control" type="text" name="coren" placeholder="COREN" id="coren">
                            <label for="coren">COREN</label>
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