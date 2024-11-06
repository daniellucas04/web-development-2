<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar receitas</title>
</head>
<body>
    <?php
    $pgAtual = 'receitas';
    include 'navbar.php';
    ?>
    <div class="container mt-5">
        <?php
        include 'conexao.php';

        $sql = "SELECT r.id, p.nome, p.leito, r.data_administracao, r.status FROM receita AS r INNER JOIN paciente AS p ON r.id_paciente = p.id";
        $select = $conn->prepare($sql);
        $select->execute();

        if ($select->rowCount() > 0):
        ?>
        <h1>Listar receitas</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Leito</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
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
                        <?php if($_SESSION['tipo_usuario'] == 'Enfermeiro' AND $linha['status'] == 'F'){ ?>
                            <td><a class="btn btn-primary" href="cadastrar_administracao.php?id=<?= $linha['id']; ?>">Registrar administração</a></td>
                        <?php } else if ($linha['status'] == 'T') { ?>
                            <?php 
                            $sql = "SELECT data_registro FROM administracao WHERE id_receita = :id_receita LIMIT 1";
                            $selectAdm = $conn->prepare($sql);
                            $selectAdm->execute(['id_receita' => $linha['id']]);
                            $dataRegistro = new DateTime($selectAdm->fetch(PDO::FETCH_ASSOC)['data_registro']);
                            ?>
                            <td><strong class="text-success">Data da administração: <?= $dataRegistro->format('d/m/Y H:i:s'); ?></strong></td>
                        <?php } else { ?>
                            <td><strong>Sem ações para realizar</strong></td>
                        <?php } ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <h5 class="alert alert-info text-center">Não foram encontradas receitas</h5>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>