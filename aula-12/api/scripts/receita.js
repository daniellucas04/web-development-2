window.onload = function() {
    let createButton = document.getElementById('create');
    
    createButton.addEventListener('click', () => {
        create();
    });
}

function create() {
    // Campos para registro da administração
    let idPaciente = document.getElementById('id_paciente').value;
    let nomeMedicamento = document.getElementById('nome_medicamento').value;
    let dose = document.getElementById('dose').value;
    let dataAdministracao = document.getElementById('data_administracao').value;

    fetch(`/api/cadastros/receita.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ 
            id_paciente: idPaciente,
            nome_medicamento: nomeMedicamento,
            dose,
            data_administracao: dataAdministracao
        })
    })
    .then(response => response.json())
    .then((data) => {
        showResult(data);
    });
}

function showResult(data) {
    let divMessage = document.getElementById('result');
    divMessage.innerHTML = data.msg;
}