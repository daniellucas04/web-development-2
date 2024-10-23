<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar notas de um aluno</title>
</head>
<body>
    <?php 
    $pgAtual = 'listar_aluno_notas';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <?php 
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            $sql = "SELECT n.id, t.nome AS nome_turma, a.nome AS nome_aluno, n.valor AS nota FROM notas AS n INNER JOIN turmas AS t ON n.id_turma = t.id INNER JOIN alunos AS a ON n.id_aluno = a.id WHERE n.id_aluno = :id_aluno ORDER BY n.valor DESC";
            $select = $conn->prepare($sql);
            $select->execute(['id_aluno' => $data['id_aluno']]);
        } else {
            $sql = "SELECT n.id, t.nome as nome_turma, n.valor as nota FROM notas AS n INNER JOIN turmas AS t ON n.id_turma = t.id ORDER BY n.valor DESC";
            $select = $conn->prepare($sql);
            $select->execute();
        }
        ?>
        <div class="d-flex justify-content-center">
            <form method="post">
                <div class="row">
                    <div class="col-7">
                        <select class="form-select form-select-lg mb-3" name="id_aluno" required>
                            <option selected disabled>Selecione um aluno</option>
                            <?php 
                            $sql = "SELECT id, nome FROM alunos";
                            $selectAluno = $conn->prepare($sql);
                            $selectAluno->execute();

                            while ($linha = $selectAluno->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $linha['id']; ?>" <?= (isset($data) AND $data['id_aluno'] == $linha['id']) ? 'selected' : '' ?>> <?= $linha['nome'] ?> </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-lg btn-primary">Listar</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $counter = 0;
        if (isset($data)): ?>
            <?php 
            $sql = "SELECT nome FROM alunos WHERE id = :id_aluno";
            $selectNomeAluno = $conn->prepare($sql);
            $selectNomeAluno->execute(['id_aluno' => $data['id_aluno']]);
            ?>
            <h1 class="mb-3">Todas as notas do aluno: <?= $selectNomeAluno->fetch(PDO::FETCH_ASSOC)['nome'] ?></h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Turma</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dados = $select->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= ++$counter ?></td>
                            <td><?= $dados['nome_turma'] ?></td>
                            <td><?= str_replace('.', ',', $dados['nota']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>