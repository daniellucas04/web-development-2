<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de aluno</title>
</head>
<body>
    <?php
    $pgAtual = 'cadastrar_aluno';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <h3>Cadastrar aluno</h3>
        <?php
        include 'conexao.php';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            try {
                $sql = "INSERT INTO alunos (nome, id_turma) VALUES (:nome, :id_turma)";
                $insert = $conn->prepare($sql);
                
                if ($insert->execute(['nome' => $data['nome'], 'id_turma' => $data['id_turma']])) {
                    echo "<div class='alert alert-success text-center'>Aluno cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>Erro ao cadastrar o aluno {$data['nome']}!</div>";
                }
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        } 
        ?>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" required>
                <label for="nome">Nome</label>
            </div>
            <select class="form-select form-select-lg mb-3" name="id_turma" required>
                <option selected disabled>Selecione uma turma</option>
                <?php 
                $sql = "SELECT id, nome FROM turmas";
                $select = $conn->prepare($sql);
                $select->execute();
                while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $linha['id']; ?>"> <?= $linha['nome'] ?> </option>
                <?php endwhile;?>
            </select>
            <button class="btn btn-primary">Cadastrar aluno</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>