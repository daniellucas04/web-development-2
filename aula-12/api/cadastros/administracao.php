<?php
include "../../conexao.php";

$error = false;
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $sql = "SELECT id FROM paciente WHERE id = :id";
    $select = $conn->prepare($sql);
    $dados = $select->execute(['id' => $data['id_paciente']]);
    
    if (!$dados) {
        $msg .= "<div class='alert alert-danger'>Erro ao encontrar este paciente. <a href='cadastrar_paciente.php'>Cadastre ele aqui</a>!</div><br>";
        $error = true;
    }
    
    if(empty($data['data_registro'])) {
        $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Data de Registro</strong></div><br>";
        $error = true;
    } else {
        $dataAtual = new DateTime();
        $dataRegistro = new DateTime($data['data_registro']);
        if($dataRegistro > $dataAtual) {
            $msg .= "<div class='alert alert-danger'>A data de registro da administração não pode ser maior que a data atual!</div><br>";
            $error = true;
        }
    }


    if (!$error) {
        try {
            $sql = "INSERT INTO administracao (id_receita, data_registro) VALUES (:id_receita, :data_registro)";
            $insert = $conn->prepare($sql);
            
            if ($insert->execute(['id_receita' => $data['id'], 'data_registro' => $data['data_registro']])) {
                $sql = "UPDATE receita SET status = :status WHERE id = :id";
                $update = $conn->prepare($sql);
                
                if ($update->execute(['status' => 'T', 'id' => $data['id']])) {
                    echo json_encode(["msg" => "<div class='alert alert-success'>Administração cadastrada com sucesso!</div>"]);
                    return;
                }
            } else {
                echo json_encode(["msg" => "<div class='alert alert-danger'>Erro ao cadastrar a administração!</div>"]);
                return;
            }
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }
    echo json_encode(["msg" => $msg]);
    return;
}
?>