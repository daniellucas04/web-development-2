<?php
include '../database/connection.php';

date_default_timezone_set('America/Sao_Paulo');
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

    $sql = "SELECT bid_price FROM bids WHERE id_item = :id_item ORDER BY bid_timestamp DESC LIMIT 1";
    $select = $database->prepare($sql);
    $select->execute(['id_item' => $data['id_item']]);
    if ($select->rowCount() > 0) {
        // Preço mínimo passa a ser o último lance
        $minimumPrice = $select->fetch(PDO::FETCH_ASSOC)['bid_price'];
    }

    if ($data['id_user'] == $idAuctioneer) { $msg .= "O <strong>dono do item leiloado</strong> não pode realizar um lance no seu próprio item.<br>"; $error = true; }
    if ($data['bid_price'] < $minimumPrice) { $msg .= "O <strong>Valor do lance</strong> não pode ser menor que o <strong>Valor mínimo</strong> do item.<br>"; $error = true; }

    $sql = "SELECT bid_timestamp FROM bids WHERE id_item = :id_item AND id_user = :id_user ORDER BY bid_timestamp DESC";
    $select = $database->prepare($sql);
    $select->execute(['id_item' => $data['id_item'], 'id_user' => $data['id_user']]);
    $bidTimestamp = $select->fetch(PDO::FETCH_ASSOC)['bid_timestamp'] ?? false;
    if ($bidTimestamp) {
        // Verifica se passou 1 dia após o último lance
        $lastBidTimestamp = new DateTime($bidTimestamp);
        $todayTimestamp = new DateTime();
        $lastBidTimestamp->add(new DateInterval('P1D'));
        
        $dayAfterBid = $lastBidTimestamp->format('Y-m-d H:i');
        $todayTimestamp = $todayTimestamp->format('Y-m-d H:i');
        if ($todayTimestamp < $dayAfterBid) { $msg .= "Você só pode realizar <strong>um lance por dia</strong>.<br>"; $error = true; }
    }

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