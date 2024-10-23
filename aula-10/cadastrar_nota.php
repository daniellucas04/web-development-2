<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de nota</title>
</head>
<body>
    <?php
    $pgAtual = 'cadastrar_nota';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <h3>Cadastrar nota</h3>
        <?php
        include 'conexao.php';

        $error = false;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $data['valor'] = str_replace(',', '.', $data['valor']);

            $sql = "SELECT id FROM alunos WHERE id = :id_aluno";
            $select = $conn->prepare($sql);
            $select->execute(['id_aluno' => $data['id_aluno']]);

            if (empty($select->fetch(PDO::FETCH_ASSOC)['id'])) {
                echo "<div class='alert alert-danger text-center'>O aluno selecionado não existe!</div>";
                $error = true;
            }

            if (empty($data['valor'])) {
                echo "<div class='alert alert-danger text-center'>Preencha o campo nota!</div>";
                $error = true;
            } else if ($data['valor'] < 0 OR $data['valor'] > 10) {
                echo "<div class='alert alert-danger text-center'>A nota precisa estar entre 0 e 10!</div>";
                $error = true;
            }

            if (empty($data['id_aluno'])) {
                echo "<div class='alert alert-danger text-center'>Selecione um aluno!</div>";
                $error = true;
            }

            if (!$error) {
                $sql = "SELECT id_turma FROM alunos WHERE id = :id";
                $select = $conn->prepare($sql);
                $select->execute(['id' => $data['id_aluno']]);
                $data['id_turma'] = $select->fetch(PDO::FETCH_ASSOC)['id_turma'] ?? null;
                
                try {
                    $sql = "INSERT INTO notas (valor, id_aluno, id_turma) VALUES (:valor, :id_aluno, :id_turma)";
                    $insert = $conn->prepare($sql);
    
                    if ($insert->execute(['valor' => $data['valor'], 'id_aluno' => $data['id_aluno'], 'id_turma' => $data['id_turma']])) {
                        echo "<div class='alert alert-success text-center'>Nota cadastrada com sucesso!</div>";
                    } else {
                        $sql = "SELECT nome FROM alunos WHERE id_aluno = :id_aluno";
                        $select = $conn->prepare($sql);
                        $select->execute();
                        $nomeAluno = $select->fetch()['nome'];
    
                        echo "<div class='alert alert-danger text-center'>Erro ao cadastrar a nota do aluno {$nomeAluno}!</div>";
                    }
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                }
            }
        } 
        ?>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="number" max="10" min="0" step="0.1" name="valor" id="nota" placeholder="Nota" required>
                <label for="nota">Nota</label>
            </div>
            <select class="form-select form-select-lg mb-3" name="id_aluno" required>
                <option selected disabled>Selecione um aluno</option>
                <?php 
                $sql = "SELECT id, nome FROM alunos";
                $select = $conn->prepare($sql);
                $select->execute();

                while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $linha['id']; ?>"> <?= $linha['nome'] ?> </option>
                <?php endwhile;?>
            </select>
            <button class="btn btn-primary">Cadastrar nota</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>