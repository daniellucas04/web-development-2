<?php
// conexao
$servidor = 'localhost';
$banco = 'livraria';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `livro` (`id`, `titulo`, `idioma`, `quantidade_paginas`, `editora`, `data_publicacao`, `isbn`) VALUES (NULL, :titulo, :idioma, :quantidade_paginas, :editora, :data_publicacao, :isbn)";

try {
    $comando = $conexao->prepare($codigoSQL);

    $titulo = $_GET['titulo'];
    $idioma = $_GET['idioma'];
    $quantidadePaginas = $_GET['quantidade_paginas'];
    $editora = $_GET['editora'];
    $dataPublicacao = $_GET['data_publicacao'];
    $isbn = $_GET['isbn'];

    $resultado = $comando->execute(array('titulo' => $titulo, 'idioma' => $idioma, 'quantidade_paginas' => $quantidadePaginas, 'editora' => $editora, 'data_publicacao' => $dataPublicacao, 'isbn' => $isbn));

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