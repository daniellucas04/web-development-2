<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login médico</title>
</head>
<body>
    <?php
    $pgAtual = '';
    include 'navbar.php';
    ?>
    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3>Login médico</h3>
                <?php 
                include "conexao.php";
        
                $error = false;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
                    if (empty($data['usuario'])) {
                        echo "<div class='alert alert-danger'>O campo usuário é obrigatório!</div>";
                        $error = true;
                    }
        
                    if (empty($data['senha'])) {
                        echo "<div class='alert alert-danger'>O campo senha é obrigatório!</div>";
                        $error = true;
                    }
        
                    $sql = "SELECT usuario, senha FROM medico WHERE usuario = :usuario";
                    $select = $conn->prepare($sql);
                    $select->execute(['usuario' => $data['usuario']]);
                    $dados = $select->fetch(PDO::FETCH_ASSOC);
        
                    if ($dados == false) {
                        echo "<div class='alert alert-danger'>Usuário não encontrado, <a href='cadastrar_medico.php'>cadastre-se aqui</a>!</div>";
                        $error = true;
                    }
        
                    if (!$error) {
                        try {
                            if($data['usuario'] == $dados['usuario'] AND $data['senha'] == $dados['senha']) {
                                echo "<div class='alert alert-success'>Login realizado com sucesso, aguarde o redirecionamento!</div>";
                                $_SESSION['tipo_usuario'] = ($dados['usuario'] == 'admin' ? 'Admin' : 'Médico');
                                $_SESSION['usuario'] = $dados['usuario'];
                                header('Location: receitas.php');
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'>Usuário ou senha incorretos. Tente novamente!</div>";
                            }
                        } catch (PDOException $exception) {
                            echo $exception->getMessage();
                        }
                    }
                }
                ?>
                <form method="post">
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
                        <div class="col mt-2">
                            <button style="width:100%;" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>