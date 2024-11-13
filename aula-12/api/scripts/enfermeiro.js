window.onload = function() {
    let createButton = document.getElementById('create');
    
    createButton.addEventListener('click', () => {
        create();
    });
}

function create() {
    // Campos para registro da administração
    let nome = document.getElementById('nome').value;
    let coren = document.getElementById('coren').value;
    let usuario = document.getElementById('usuario').value;
    let senha = document.getElementById('senha').value;


    fetch(`/api/cadastros/enfermeiro.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({ 
            nome,
            coren,
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