<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Recebe</title>
</head>
<body>
    <?php 
    $pg_atual = 'recebe';

    include 'aluno.php';
    include 'menu.php';

    session_start();


    if($_POST) {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $aluno = new Aluno;

        $aluno->setNome($post['nome']);
        $aluno->setDataNascimento(Aluno::formatDateBR($post['data_nascimento']));
        $aluno->setMatricula($post['matricula']);
        $aluno->setCurso($post['curso']);

        $_SESSION['aluno'] = serialize($aluno);
    } else {
        header('Location: formulario.php');
    }
    ?>
    <div class="container mt-4">
        <!-- Button trigger modal -->
        <div class="row">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal">Mostrar</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="showModalLabel">Dados do aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Nome: <?= (isset($aluno)) ? $aluno->getNome() : '' ?></li>
                        <li class="list-group-item">Data nascimento: <?= (isset($aluno)) ? Aluno::formatDateBR($aluno->getDataNascimento()) : '' ?></li>
                        <li class="list-group-item">Matricula: <?= (isset($aluno)) ? $aluno->getMatricula() : '' ?></li>
                        <li class="list-group-item">Curso: <?= (isset($aluno)) ? $aluno->getCurso() : '' ?></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirm" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('confirm').addEventListener('click', () => {
            window.location.href = "mostra.php";
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>