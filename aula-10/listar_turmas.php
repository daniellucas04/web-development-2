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
    $pgAtual = 'listar_turmas';
    include 'menu.php';
    ?>
    <div class="container mt-5">
        <?php 
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $sql = "SELECT nome FROM turmas WHERE id = :id";
            $select = $conn->prepare($sql);
            $select->execute(['id' => $data['id']]);
            $nomeTurma = $select->fetch(PDO::FETCH_ASSOC)['nome'];

            try {
                $sql = "DELETE FROM turmas WHERE id = :id";
                $delete = $conn->prepare($sql);
                $delete->execute(['id' => $data['id']]);

                if ($delete->rowCount() > 0) {
                    echo "<div class='alert alert-success text-center'>A turma <strong>{$nomeTurma}</strong> foi excluida com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>Não foi possível excluir a turma <strong>{$nomeTurma}</strong>!</div>";
                }
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        
        $sql = "SELECT id, nome FROM turmas";
        $select = $conn->prepare($sql);
        $select->execute();
        ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($dados = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $dados['id'] ?></td>
                        <td><?= $dados['nome'] ?></td>
                        <td class="d-flex gap-1">
                            <a class="btn btn-sm btn-primary" href="#">Editar</a>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $dados['id'] ?>">
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile;?>
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>