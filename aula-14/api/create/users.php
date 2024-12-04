<?php
include '../database/connection.php';

$error = false;
$msg = '';
$table = 'users';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validações
    if (empty($data['username'])) { $msg .= "O campo <strong>Usuário</strong> é obrigatório.<br>"; $error = true; }
    if (empty($data['email'])) { 
        $msg .= "O campo <strong>E-mail</strong>.<br>"; $error = true; 
    } else {
        $sql = "SELECT id FROM users WHERE email = :email";
        $select = $database->prepare($sql);
        $select->execute(['email' => $data['email']]);
        $userData = $select->fetch(PDO::FETCH_ASSOC);
        
        if ( isset($userData) AND !empty($userData) ) { $msg .= "O e-mail <strong>{$data['email']}</strong> já está cadastrado.<br>"; $error = true; }
    }
    if (empty($data['password'])) { $msg .= "O campo <strong>Senha</strong> é obrigatório."; $error = true; }

    if (!$error) {
        try {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $username = ucfirst($data['username']);

            $sql = "INSERT INTO $table (username, email, password) VALUES (:username, :email, :password)";
            $insert = $database->prepare($sql);

            if ($insert->execute(['username' => $data['username'], 'email' => $data['email'], 'password' => $data['password']])) {
                echo json_encode(['success' => true, 'message' => "Usuário <strong>{$username}</strong> cadastrado com sucesso."]);                
                return;
            } else {
                echo json_encode(['success' => false, 'message' => "Não foi possível cadastrar o usuário {$data['username']}."]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    echo json_encode(['success' => false, 'message' => $msg]);
    return;
}