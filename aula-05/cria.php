<?php

if($_SERVER['REQUEST_METHOD'] === "POST") {
    session_start();
    include 'produto.php';

    $produto = new Produto($_POST['nome'], $_POST['descricao'], $_POST['valor'], $_POST['imagem']);
    $_SESSION['produto'][] = serialize($produto);
    header('Location: mostra.php');
} else {
    header('Location: novo.php');
}