window.onload = function() {
    let createButton = document.getElementById('create');
    
    createButton.addEventListener('click', () => {
        create();
    });
}

function create() {
    // Campos para registro da administração
    let nome = document.getElementById('nome').value;
    let especialidade = document.getElementById('especialidade').value;
    let crm = document.getElementById('crm').value;
    let usuario = document.getElementById('usuario').value;
    let senha = document.getElementById('senha').value;


    fetch(`/api/cadastros/medico.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ 
            nome,
            especialidade,
            crm,
            usuario,
            senha 
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