<?php
include '../database/connection.php';

$error = false;
$msg = '';
$table = 'departments';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validações
    if (empty($data['name'])) { $msg .= "O campo <strong>Nome</strong> é obrigatório.<br>"; $error = true; }

    if (!$error) {
        try {
            $departmentName = ucfirst($data['name']);

            $sql = "INSERT INTO $table (name) VALUES (:name)";
            $insert = $database->prepare($sql);
            
            if ($insert->execute(['name' => $data['name']])) {
                echo json_encode(['success' => true, 'message' => "Departamento <strong>{$departmentName}</strong> cadastrado com sucesso."]);                
                return;
            } else {
                echo json_encode(['success' => false, 'message' => "Não foi possível cadastrar o departamento <strong>{$departmentName}</strong>."]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    echo json_encode(['success' => false, 'message' => $msg]);
    return;
}