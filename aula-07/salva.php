<?php
// conexao
$servidor = 'localhost';
$banco = 'receitas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `ingredientes` (`id`, `nome`, `quantidade`) VALUES (NULL, :nome, :quantidade)";

try {
    $comando = $conexao->prepare($codigoSQL);

    $nome = $_GET['nome'];
    $quantidade = str_replace(',', '.', $_GET['quantidade']);
    $resultado = $comando->execute(array('nome' => $nome, 'quantidade' => $quantidade));

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