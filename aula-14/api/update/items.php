<?php
include '../database/connection.php';

$table = 'requests';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

    $sql = "UPDATE $table SET status = :status WHERE id = :id";
    $update = $database->prepare($sql);
    $update->execute(['status' => 'T', 'id' => $id]);
    header('Location: /chamado/listar');
}