<?php 
$servidor = 'localhost';
$banco = 'loja';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

if (count($_GET) > 1) {
    $codigoSQL = "UPDATE produtos SET nome = :nome, foto_url = :foto_url, descricao = :descricao, preco = :preco WHERE id = :id";
    
    try {
        $resultado = $conexao->prepare($codigoSQL);
        $resultado = $resultado->execute(['nome' => $_GET['nome'], 'foto_url' => $_GET['foto_url'], 'descricao' => $_GET['descricao'], 'preco' => $_GET['preco'], 'id' => $_GET['id']]);
    
        if ($resultado) {
            echo 'Dados atulizados com sucesso!';    
        } else {
            echo 'Erro ao atualizar os dados!';
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
    
    $conexao = null;
    header("Location: mostra_produtos.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Atualizar produto</title>
</head>
<body>
    <?php 
    $pgAtual = 'produtos';
    include('navbar.php');
    ?>
    <div class="container mt-4">
        <?php
        $comando = $conexao->prepare("SELECT * FROM produtos WHERE id = {$_GET['id']}");
        $resultado = $comando->execute();

        if ($resultado){
            if($linha = $comando->fetch(PDO::FETCH_ASSOC)):
        ?>
            <form>
                <label for="titulo">Nome</label>
                <input class="form-control" type="text" value="<?= $linha['nome'] ?>" name="nome" id="nome">
                <label for="editora">Foto URL</label>
                <input class="form-control" type="text" value="<?= $linha['foto_url'] ?>" name="foto_url" id="foto_url">
                <label for="editora">Descricao</label>
                <input class="form-control" type="text" value="<?= $linha['descricao'] ?>" name="descricao" id="descricao">
                <label for="editora">Preço</label>
                <input class="form-control" type="text" value="<?= $linha['preco'] ?>" name="preco" id="preco">
                <input type="hidden" value="<?= $linha['id'] ?>" name="id">
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit">Editar</button>
                </div>
            </form>
        <?php
            endif;
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>