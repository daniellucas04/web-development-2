<?php
include '../database/connection.php';

$table = 'items';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'] ?? null;

    $sql = "SELECT id_user FROM bids WHERE id_item = :id ORDER BY bid_timestamp DESC LIMIT 1";
    $select = $database->prepare($sql);
    $select->execute(['id' => $id]);
    $idWinner = $select->fetch(PDO::FETCH_ASSOC)['id_user'];

    $sql = "UPDATE $table SET status = :status, winner = :winner WHERE id = :id";
    $update = $database->prepare($sql);
    $update->execute(['status' => 'F', 'id' => $id, 'winner' => $idWinner]);
    header('Location: /item/meus-itens');
}