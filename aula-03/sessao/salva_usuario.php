<?php 
session_start();
$pg_atual = 'salva_usuario';
include 'navbar.php';

if(isset($_SESSION['nome'])) {
    header('Location: mostra_usuario.php');
} else {
    header('Location: mostra_usuario.php');
}

if(isset($_POST['nome'])) {
    $_SESSION['nome'] = $_POST['nome'];
    header('Location: mostra_usuario.php');
}
?>