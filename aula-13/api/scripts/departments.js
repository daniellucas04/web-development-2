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
    let name = document.getElementsByName('name')[0].value;

    data = {
        name,
    }

    fetch(`/api/create/departments.php`, {
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

function read () {
    fetch(`/api/read/departments.php`, {
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