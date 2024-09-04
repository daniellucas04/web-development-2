<?php
session_start(); // Inicia a sessão para que possamos destruí-la

$_SESSION = array();

// Destrói os dados da sessão no servidor
session_destroy();

// Apaga o cookie da sessão (opcional, mas recomendado)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

header('Location: primeira.php');
?>