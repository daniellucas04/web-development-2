<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastrar</title>
</head>
<body style="margin: 0;padding: 0;">
    <?php 
    $pg_atual = 'formulario';
    include "menu.php"; 
    ?>

    <div class="container mt-4">
        <h1>Dados do aluno</h1>
        <form action="recebe.php" method="post">
            <?php 
            include 'aluno.php';
            session_start();

            if(isset($_SESSION['aluno'])) {
                $aluno = unserialize($_SESSION['aluno']);
            }
            ?>
            <div class="row">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= (isset($aluno)) ? $aluno->getNome() : '' ?>" required>
            </div>
            <div class="row">
                <label for="data_nascimento" class="form-label">Data Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= (isset($aluno)) ? Aluno::formatDateUS($aluno->getDataNascimento()) : '' ?>" required>
            </div>
            <div class="row">
                <label for="matricula" class="form-label">Matricula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="<?= (isset($aluno)) ? $aluno->getMatricula() : '' ?>" required>
            </div>
            <div class="row">
                <label for="curso" class="form-label">Curso</label>
                <input type="text" class="form-control" id="curso" name="curso" value="<?= (isset($aluno)) ? $aluno->getCurso() : '' ?>" required>
            </div>
            <div class="row mt-3">
                <button class="btn btn-success">Enviar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

