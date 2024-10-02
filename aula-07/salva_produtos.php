<?php
// conexao
$servidor = 'localhost';
$banco = 'loja';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `produtos` (`id`, `nome`, `foto_url`, `descricao`, `preco`) VALUES (NULL, :nome, :foto_url, :descricao, :preco)";

try {
    $comando = $conexao->prepare($codigoSQL);

    $nome = $_GET['nome'];
    $fotoUrl = $_GET['foto_url'];
    $descricao = $_GET['descricao'];
    $preco = str_replace(',', '.', $_GET['preco']);
    $resultado = $comando->execute(array('nome' => $nome, 'foto_url' => $fotoUrl, 'descricao' => $descricao, 'preco' => $preco));

    if($resultado) {
	    echo "Comando executado!";
    } else {
	    echo "Erro ao executar o comando!";
    }
} catch (Exception $e) {
    echo "Erro $e";
}

$conexao = null;
?>