<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastrar paciente</title>
</head>
<body>
    <?php 
    session_start();
    if ($_SESSION['tipo_usuario'] == 'medico' OR $_SESSION['tipo_usuario'] == 'enfermeiro') {
    ?>
    <div class="container mt-5">
        <h1>Cadastrar paciente</h1>
        <?php 
        include "conexao.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            try {
                $sql = "INSERT INTO paciente (nome, leito) values (:nome, :leito)";
                $insert = $conn->prepare($sql);
                
                if ($insert->execute(['nome' => $data['nome'], 'leito' => $data['leito']])) {
                    echo "<div class='alert alert-success'>Paciente cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Erro ao cadastrar o paciente!</div>";
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
                        <input required class="form-control" type="text" name="leito" placeholder="Leito" id="leito">
                        <label for="leito">Leito</label>
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