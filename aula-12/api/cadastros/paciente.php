<?php 
include "../../conexao.php";

$error = false;
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if(empty($data['nome'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Nome</strong>!</div><br>"; $error = true; }
    if(empty($data['leito'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Leito</strong>!</div><br>"; $error = true; }

    if(!$error) {
        try {
            $sql = "INSERT INTO paciente (nome, leito) values (:nome, :leito)";
            $insert = $conn->prepare($sql);
            
            if ($insert->execute(['nome' => $data['nome'], 'leito' => $data['leito']])) {
                echo json_encode(['msg' => "<div class='alert alert-success'>Paciente cadastrado com sucesso!</div>"]);
                return;
            } else {
                echo json_encode(['msg' => "<div class='alert alert-danger'>Erro ao cadastrar o paciente!</div>"]);
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