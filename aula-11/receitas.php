<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar receitas</title>
</head>
<body>
    <div class="container mt-5">
        <?php 
        include 'conexao.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            try {
                $sql = "UPDATE receita SET status = 'T' WHERE id = :id";
                $update = $conn->prepare($sql);
                $update->execute(['id' => $data['id']]);

                if ($update->rowCount() > 0) {
                    echo "<div class='alert alert-success'>Receita finalizada com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-success'>Erro ao finalizar a receita!</div>";
                }
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        ?>
        <h1>Listar receitas pendentes</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Leito</th>
                    <th>Estado</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT r.id, p.nome, p.leito, r.data_administracao, r.status FROM receita AS r INNER JOIN paciente AS p ON r.id_paciente = p.id";
                $select = $conn->prepare($sql);
                $select->execute();

                while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php 
                    $dataFormatada = new DateTime($linha['data_administracao']);
                    $status = ($linha['status'] == 'F') ? 'Pendente' : 'Finalizado';
                    $class = ($linha['status'] == 'F') ? 'text-warning' : 'text-success';
                    ?>
                    <tr>
                        <td><?= $dataFormatada->format('d/m/Y H:i:s'); ?></td>
                        <td><?= $linha['leito']; ?></td>
                        <td class="<?= $class; ?>"><strong><?= $status; ?></strong></td>
                        <td class="row">
                            <div class="col">
                                <a class="btn btn-primary" href="cadastrar_administracao.php?id=<?= $linha['id']; ?>">Registrar administração</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>