window.onload = function() {
    let createButton = document.getElementById('create');

    if (createButton) {
        createButton.addEventListener('click', () => {
            create();
        });
    }

    let readElement = document.getElementById('read');
    
    if (readElement) {
        read();
    }
}

function create() {
    // Campos para registro da administração
    let username = document.getElementsByName('username')[0].value;
    let email = document.getElementsByName('email')[0].value;
    let password = document.getElementsByName('password')[0].value;

    data = {
        username,
        email,
        password,
    }

    fetch(`/api/create/users.php`, {
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then((data) => {
        showResult(data);
    });
}

function showResult(data) {
    let divMessage = document.getElementById('result');

    if ( data.success ) {
        divMessage.className = "alert alert-success";
    } else {
        divMessage.className = "alert alert-danger";
    }
    
    divMessage.innerHTML = data.message;
}

function read() {
    fetch(`/api/read/users.php`, {
        headers: {
            'Content-Type': 'text/html'
        },
        method: 'GET',
    })
    .then(response => response.text())
    .then((data) => {
        showTable(data);
    });
}

function showTable(data) {
    let divTable = document.getElementById('read');

    divTable.innerHTML = String(data);
}