<?php
include '../database/connection.php';

$error = false;
$msg = '';
$table = 'requests';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validações
    if (empty($data['id_department'])) { $msg .= "O campo <strong>Departamento</strong> é obrigatório.<br>"; $error = true; }
    if (empty($data['id_technician'])) { $msg .= "O campo <strong>Técnico</strong> é obrigatório.<br>"; $error = true; }
    if (empty($data['description'])) { $msg .= "O campo <strong>Descrição</strong> é obrigatório.<br>"; $error = true; }
    if (empty($data['limit_date'])) { 
        $msg .= "O campo <strong>Data e Hora limite</strong> é obrigatório.<br>"; $error = true;
    } else {
        $limitDate = new DateTime($data['limit_date']);
        $today = new DateTime();

        if ($limitDate < $today) {
            $msg .= "A <strong>Data e Hora limite</strong> precisa ser maior ou igual a data atual.<br>";
            $error = true;
        }
    }

    if (!$error) {
        try {
            $departmentName = ucfirst($data['name']);

            $sql = "INSERT INTO $table (id_department, id_user, id_technician, description, priority, limit_date) VALUES (:id_department, :id_user, :id_technician, :description, :priority, :limit_date)";
            $insert = $database->prepare($sql);
            
            if ($insert->execute(['id_department' => $data['id_department'], 'id_user' => $data['id_user'], 'id_technician' => $data['id_technician'], 'description' => $data['description'], 'priority' => $data['priority'], 'limit_date' => $data['limit_date']])) {
                echo json_encode(['success' => true, 'message' => "Chamado <strong>{$departmentName}</strong> cadastrado com sucesso."]);                
                return;
            } else {
                echo json_encode(['success' => false, 'message' => "Não foi possível cadastrar o chamado <strong>{$departmentName}</strong>."]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    echo json_encode(['success' => false, 'message' => $msg]);
    return;
}