<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar turmas</title>
</head>
<body>
    <?php 
    $pgAtual = 'listar_alunos';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <?php 
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            try {
                $sql = "DELETE FROM notas WHERE id_aluno = :id";
                $delete = $conn->prepare($sql);
                $delete->execute(['id' => $data['id']]);

                $sql = "DELETE FROM alunos WHERE id = :id";
                $delete = $conn->prepare($sql);
                $delete->execute(['id' => $data['id']]);

                if ($delete->rowCount() > 0) {
                    echo "<div class='alert alert-success text-center'>Aluno deletado com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>Erro ao deletar o aluno!</div>";
                }
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        
        $sql = "SELECT a.id, a.nome, t.nome AS nome_turma FROM alunos AS a INNER JOIN turmas AS t ON a.id_turma = t.id ORDER BY a.nome ASC";
        $select = $conn->prepare($sql);
        $select->execute();
        $counter = 0;
        ?>
        <h3 class="mb-3">Todos os alunos</h3>
        <table class="table table-striped table-hover mb-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Nota</th>
                    <th>Turma</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= ++$counter ?></td>
                        <td><?= $dados['nome'] ?></td>
                        <td>
                            <?php 
                            $sql = "SELECT valor FROM notas WHERE id_aluno = :id";
                            $selectNotas = $conn->prepare($sql);
                            $selectNotas->execute(['id' => $dados['id']]);

                            while ($notas = $selectNotas->fetch(PDO::FETCH_ASSOC)) {
                                $nota = str_replace('.', ',', $notas['valor']);
                                echo "<span class='px-2'>{$nota}</span>";
                            }
                            ?>
                        </td>
                        <td><?= $dados['nome_turma'] ?></td>
                        <td class="d-flex gap-1">
                            <a class="btn btn-sm btn-primary" href="editar_aluno.php?id=<?= $dados['id']; ?>">Editar</a>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $dados['id'] ?>">
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <small><span class="alert alert-warning">* Ao excluir o aluno, suas notas também serão excluídas!</span></small>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>