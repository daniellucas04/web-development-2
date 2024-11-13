window.onload = function() {
    let createButton = document.getElementById('create');
    
    createButton.addEventListener('click', () => {
        create();
    });
}

function create() {
    // Campos para registro da administração
    let idAdministration = document.getElementById('id').value;
    let idPaciente = document.getElementById('id_paciente').value;
    let nomeMedicamento = document.getElementById('nome_medicamento').value;
    let dose = document.getElementById('dose').value;
    let dataRegistro = document.getElementById('data_registro').value;


    fetch(`/api/cadastros/administracao.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ 
            id: idAdministration,
            id_paciente: idPaciente,
            nome_medicamento: nomeMedicamento,
            dose: dose,
            data_registro: dataRegistro 
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