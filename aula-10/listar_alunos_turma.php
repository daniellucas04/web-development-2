<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar alunos de uma turma</title>
</head>
<body>
    <?php 
    $pgAtual = 'listar_alunos_turma';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <?php 
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            $sql = "SELECT a.id, a.nome, t.nome as nome_turma, n.valor as nota FROM alunos AS a INNER JOIN turmas AS t ON a.id_turma = t.id INNER JOIN notas AS n ON a.id = n.id_aluno WHERE a.id_turma = :id_turma ORDER BY a.nome ASC";
            $select = $conn->prepare($sql);
            $select->execute(['id_turma' => $data['id_turma']]);
        } else {
            $sql = "SELECT a.id, a.nome, t.nome as nome_turma, n.valor as nota FROM alunos AS a INNER JOIN turmas AS t ON a.id_turma = t.id INNER JOIN notas AS n ON a.id = n.id_aluno ORDER BY a.nome ASC";
            $select = $conn->prepare($sql);
            $select->execute();
        }
        ?>
        <div class="d-flex justify-content-center">
            <form method="post">
                <div class="row">
                    <div class="col-7">
                        <select class="form-select form-select-lg mb-3" name="id_turma" required>
                            <option selected disabled>Selecione uma turma</option>
                            <?php 
                            $sql = "SELECT id, nome FROM turmas";
                            $selectTurma = $conn->prepare($sql);
                            $selectTurma->execute();
        
                            while ($linha = $selectTurma->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $linha['id']; ?>" <?= (isset($data) AND $data['id_turma'] == $linha['id']) ? 'selected' : '' ?>> <?= $linha['nome'] ?> </option>
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
        if(isset($data)):?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dados = $select->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= $dados['id'] ?></td>
                            <td><?= $dados['nome'] ?></td>
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