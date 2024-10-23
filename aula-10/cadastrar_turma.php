<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de turmas</title>
</head>
<body>
    <?php
    $pgAtual = 'cadastrar_turma';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <h3>Cadastrar turma</h3>
        <?php
        include 'conexao.php';
        $error = false;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            if (empty($data['nome'])) {
                echo "<div class='alert alert-danger text-center'>O nome da turma é obrigatório!</div>";
                $error = true;
            }
            if (!$error) {
                try {
                    $sql = "INSERT INTO turmas (nome) VALUES (:nome)";
                    $insert = $conn->prepare($sql);
                    
                    if ($insert->execute(['nome' => $data['nome']])) {
                        echo "<div class='alert alert-success text-center'>Turma cadastrada com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger text-center'>Erro ao cadastrar a turma {$data['nome']}!</div>";
                    }
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
        } 
        ?>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" required>
                <label for="nome">Nome</label>

            </div>
            <button class="btn btn-primary">Cadastrar turma</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>