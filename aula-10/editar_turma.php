<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edição de turmas</title>
</head>
<body>
    <?php
    $pgAtual = 'listar_turmas';
    include 'menu.php';

    $id = $_GET['id'] ?? null;
    ?>
    <div class="container mt-5">
        <h3>Editar turma</h3>
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
                    $sql = "UPDATE turmas SET nome = :nome WHERE id = :id";
                    $update = $conn->prepare($sql);
                    
                    if ($update->execute(['nome' => $data['nome'], 'id' => $id])) {
                        echo "<div class='alert alert-success text-center'>Turma editada com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger text-center'>Erro ao editar a turma {$data['nome']}!</div>";
                    }
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
        }

        $sql = "SELECT nome FROM turmas WHERE id = :id";
        $select = $conn->prepare($sql);
        $select->execute(['id' => $id]);
        $dados = $select->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" value="<?= $dados['nome'] ?>" required>
                <label for="nome">Nome</label>

            </div>
            <button class="btn btn-primary">Editar turma</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>