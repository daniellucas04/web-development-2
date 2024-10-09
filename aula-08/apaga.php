<?php 

$servidor = 'localhost';
$usuario = 'root';
$senha = '';

if($_GET['page'] == 'livro') {
    $banco = 'livraria';
    $table = 'livro';
    $redirect = 'mostra_livros.php';
} elseif($_GET['page'] == 'time') {
    $banco = 'futebol';
    $table = 'times';
    $redirect = 'mostra_times.php';
} else {
    $banco = 'loja';
    $table = 'produtos';
    $redirect = 'mostra_produtos.php';
}

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "DELETE FROM `$table` WHERE id = {$_GET['id']}";

try {
    $resultado = $conexao->exec($codigoSQL);

    if($resultado != 0) {
        echo 'Item apagado!';
    } else {
        echo 'Erro ao apagar o item!';
    }
} catch (PDOException $exception) {
    echo $exception->getMessage();
}

$conexao = null;

header("Location: $redirect");
?>