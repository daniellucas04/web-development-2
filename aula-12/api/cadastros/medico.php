<?php 
include "../../conexao.php";

$error = false;
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if(empty($data['nome'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Nome</strong>!</div>"; $error = true; }
    if(empty($data['especialidade'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Especialidade</strong>!</div>"; $error = true; }
    if(empty($data['crm'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>CRM</strong>!</div>"; $error = true; }
    if(empty($data['usuario'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Usuário</strong>!</div>"; $error = true; }
    if(empty($data['nome'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Senha</strong>!</div>"; $error = true; }

    if (!$error) {
        try {
            $sql = "INSERT INTO medico (nome, especialidade, crm, usuario, senha) values (:nome, :especialidade, :crm, :usuario, :senha)";
            $insert = $conn->prepare($sql);
            
            if ($insert->execute(['nome' => $data['nome'], 'especialidade' => $data['especialidade'], 'crm' => $data['crm'], 'usuario' => $data['usuario'], 'senha' => $data['senha']])) {
                echo json_encode(['msg' => "<div class='alert alert-success'>Médico cadastrado com sucesso!</div>"]);
                return;
            } else {
                echo json_encode(['msg' => "<div class='alert alert-danger'>Erro ao cadastrar o médico!</div>"]);
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