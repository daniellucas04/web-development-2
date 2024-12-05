<?php
include '../database/connection.php';

$error = false;
$msg = '';
$table = 'bids';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    // Prepara os dados para inserção
    $data['bid_price'] = str_replace(',', '.', $data['bid_price']);

    // Validações
    if (empty($data['bid_price'])) { $msg .= "O campo <strong>Valor do lance</strong> é obrigatório.<br>"; $error = true; }
    if (!is_numeric($data['bid_price'])) { $msg .= "O campo <strong>Valor do lance</strong> deve ser numérico.<br>"; $error = true; }

    $sql = "SELECT id_auctioneer, minimum_price FROM items WHERE id = :id";
    $select = $database->prepare($sql);
    $select->execute(['id' => $data['id_item']]);
    $itemsRow = $select->fetch(PDO::FETCH_ASSOC);
    
    $idAuctioneer = $itemsRow['id_auctioneer'];
    $minimumPrice = $itemsRow['minimum_price'];

    if ($data['id_user'] == $idAuctioneer) { $msg .= "O <strong>dono do item leiloado</strong> não pode realizar um lance no seu próprio item.<br>"; $error = true; }
    if ($data['bid_price'] < $minimumPrice) { $msg .= "O <strong>Valor do lance</strong> não pode ser menor que o <strong>Valor mínimo</strong> do item.<br>"; $error = true; }

    if (!$error) {
        try {
            $sql = "INSERT INTO $table (id_item, id_user, bid_price) VALUES (:id_item, :id_user, :bid_price)";
            $insert = $database->prepare($sql);

            if ($insert->execute(['id_item' => $data['id_item'], 'id_user' => $data['id_user'], 'bid_price' => $data['bid_price']])) {
                echo json_encode(['success' => true, 'message' => "Lance efetuado com sucesso."]);
                return;
            } else {
                echo json_encode(['success' => false, 'message' => "Não foi possível realizar o lance."]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    echo json_encode(['success' => false, 'message' => $msg]);
    return;
}