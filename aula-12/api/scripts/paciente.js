window.onload = function() {
    let createButton = document.getElementById('create');
    
    createButton.addEventListener('click', () => {
        create();
    });
}

function create() {
    // Campos para registro da administração
    let nome = document.getElementById('nome').value;
    let leito = document.getElementById('leito').value;

    fetch(`/api/cadastros/paciente.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ 
            nome,
            leito
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