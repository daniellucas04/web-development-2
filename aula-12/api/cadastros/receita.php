<?php 
include "../../conexao.php";

$error = false;
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if(empty($data['id_paciente']) OR !is_numeric($data['id_paciente'])) { $msg .= "<div class='alert alert-danger'>Selecione um <strong>Paciente</strong> válido!</div><br>"; $error = true; }
    if(empty($data['nome_medicamento'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Nome do medicamento</strong>!</div><br>"; $error = true; }
    if(empty($data['dose'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Dose</strong>!</div><br>"; $error = true; }
    if(empty($data['data_administracao'])) { $msg .= "<div class='alert alert-danger'>Preencha o campo <strong>Data da Administração</strong>!</div><br>"; $error = true; }

    $sql = "SELECT id FROM paciente WHERE id = :id";
    $select = $conn->prepare($sql);
    $dados = $select->execute(['id' => $data['id_paciente']]);

    if (!$dados) { $msg .= "<div class='alert alert-danger'>Erro ao encontrar este paciente. <a href='cadastrar_paciente.php'>Cadastre ele aqui</a>!</div><br>"; $error = true;}

    if (!$error) {
        try {
            $sql = "INSERT INTO receita (id_paciente, nome_medicamento, dose, data_administracao) VALUES (:id_paciente, :nome_medicamento, :dose, :data_administracao)";
            $insert = $conn->prepare($sql);
            
            if ($insert->execute(['id_paciente' => $data['id_paciente'], 'nome_medicamento' => $data['nome_medicamento'], 'dose' => $data['dose'], 'data_administracao' => $data['data_administracao']])) {
                echo json_encode(['msg' => "<div class='alert alert-success'>Receita cadastrada com sucesso!</div>"]);
                return;
            } else {
                echo json_encode(['msg' => "<div class='alert alert-danger'>Erro ao cadastrar a Receita!</div>"]);
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