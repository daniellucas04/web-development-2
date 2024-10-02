<?php
// conexao
$servidor = 'localhost';
$banco = 'futebol';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `times` (`id`, `nome`, `pontos`) VALUES (NULL, :nome, :pontos)";

try {
    $comando = $conexao->prepare($codigoSQL);

    $nome = $_GET['nome'];
    $pontos = str_replace(',', '.', $_GET['pontos']);
    $resultado = $comando->execute(array('nome' => $nome, 'pontos' => $pontos));

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