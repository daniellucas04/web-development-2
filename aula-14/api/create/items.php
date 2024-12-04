<?php
include '../database/connection.php';

$error = false;
$msg = '';
$table = 'items';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $image = $_FILES['image'];

    // Validações
    if (empty($data['name'])) { $msg .= "O campo <strong>Nome</strong> é obrigatório.<br>"; $error = true; }
    if (empty($image)) { $msg .= "O campo <strong>Imagem</strong> é obrigatório.<br>"; $error = true; }
    if ($image['error'] != 0) { $msg .= "Ocorreu um erro com a <strong>Imagem</strong>."; $error = true; }
    if (empty($data['minimum_price'])) { $msg .= "O campo <strong>Preço mínimo</strong> é obrigatório.<br>"; $error = true; }

    // Prepara os dados para inserção
    $data['minimum_price'] = str_replace(',', '.', $data['minimum_price']);

    if (!$error) {
        try {
            $sql = "INSERT INTO $table (name, image, minimum_price) VALUES (:name, :image, :minimum_price)";
            $insert = $database->prepare($sql);
            
            if ($insert->execute(['name' => $data['name'], 'image' => $image['name'], 'minimum_price' => $data['minimum_price']])) {
                $lastId = $database->lastInsertId();
                $pathToSaveFile = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $lastId . DIRECTORY_SEPARATOR;
        
                if (!is_dir($pathToSaveFile)) {
                    mkdir($pathToSaveFile, 0777, true);
                }
        
                // Erro ao salvar a imagem
                if (!move_uploaded_file($image['tmp_name'], $pathToSaveFile . $image['name'])) {
                    echo json_encode(['success' => false, 'message' => "Não foi possível salvar a imagem."]);
                    return;
                }

                echo json_encode(['success' => true, 'message' => "Item cadastrado com sucesso."]);
                return;
            } else {
                echo json_encode(['success' => false, 'message' => "Não foi possível cadastrar o item."]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    echo json_encode(['success' => false, 'message' => $msg]);
    return;
}