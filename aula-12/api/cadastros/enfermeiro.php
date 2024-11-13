<?php 
include "../../conexao.php";

$error = false;
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if(empty($data['nome'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Nome</strong>!</div><br>"; $error = true; }
    if(empty($data['coren'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>COREN</strong>!</div><br>"; $error = true; }
    if(empty($data['usuario'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Usuário</strong>!</div><br>"; $error = true; }
    if(empty($data['senha'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Senha</strong>!</div><br>"; $error = true; }

    if(!$error) {
        try {
            $sql = "INSERT INTO enfermeiro (nome, coren, usuario, senha) values (:nome, :coren, :usuario, :senha)";
            $insert = $conn->prepare($sql);
            
            if ($insert->execute(['nome' => $data['nome'], 'coren' => $data['coren'], 'usuario' => $data['usuario'], 'senha' => $data['senha']])) {
                echo json_encode(['msg' => "<div class='alert alert-success'>Enfermeiro cadastrado com sucesso!</div>"]);
                return;
            } else {
                echo json_encode(['msg' => "<div class='alert alert-danger'>Erro ao cadastrar o enfermeiro!</div>"]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    
    echo json_encode(['msg' => $msg]);
    return;
}
?>