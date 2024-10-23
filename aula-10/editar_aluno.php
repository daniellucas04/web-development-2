<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edição de aluno</title>
</head>
<body>
    <?php
    $pgAtual = 'listar_alunos';
    include 'menu.php';

    $id = $_GET['id'] ?? null;
    ?>
    <div class="container mt-5">
        <h3>Editar aluno</h3>
        <?php
        include 'conexao.php';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            try {
                $sql = "UPDATE alunos SET nome = :nome, id_turma = :id_turma WHERE id = :id";
                $update = $conn->prepare($sql);
                
                if ($update->execute(['nome' => $data['nome'], 'id_turma' => $data['id_turma'], 'id' => $id])) {
                    $sql = "UPDATE notas SET valor = :nota WHERE id = :id_nota";
                    $update = $conn->prepare($sql);
                    if ($update->execute(['nota' => $data['valor'], 'id_nota' => $data['id_nota']])) {
                        echo "<div class='alert alert-success text-center'>Aluno editado com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger text-center'>Erro ao editar a nota do aluno {$data['nome']}!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger text-center'>Erro ao editar o aluno {$data['nome']}!</div>";
                }
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }

        $sql = "SELECT a.id_turma, a.nome AS nome_aluno, n.id AS id_nota, n.valor AS nota, t.nome AS nome_turma FROM alunos AS a INNER JOIN turmas AS t ON a.id_turma = t.id INNER JOIN notas AS n ON a.id = n.id_aluno WHERE a.id = :id";
        $select = $conn->prepare($sql);
        $select->execute(['id' => $id]);
        $dados = $select->fetch(PDO::FETCH_ASSOC);
        ?>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" value="<?= $dados['nome_aluno'] ?>" required>
                <label for="nome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="hidden" name="id_nota" value="<?= $dados['id_nota'] ?>">
                <input class="form-control" type="number" max="10" min="0" step="0.1" name="valor" id="nota" placeholder="Nota" value="<?= $dados['nota'] ?>" required>
                <label for="nota">Nota</label>
            </div>
            <select class="form-select form-select-lg mb-3" name="id_turma" required>
                <option disabled>Selecione uma turma</option>
                <?php
                $sql = "SELECT id, nome FROM turmas";
                $select = $conn->prepare($sql);
                $select->execute();
                while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $linha['id']; ?>" <?= ($dados['id_turma'] == $linha['id']) ? 'selected' : '' ?> > <?= $linha['nome'] ?> </option>
                <?php endwhile; ?>
            </select>
            <button class="btn btn-primary">Editar aluno</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>