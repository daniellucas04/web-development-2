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
    let idUser = document.getElementsByName('id_user')[0].value;
    let idTechnician = document.getElementsByName('id_technician')[0].value;
    let idDepartment = document.getElementsByName('id_department')[0].value;
    let description = document.getElementsByName('description')[0].value;
    let priority = document.getElementsByName('priority')[0].value;
    let limitDate = document.getElementsByName('limit_date')[0].value;

    data = {
        id_user: idUser,
        id_technician: idTechnician,
        id_department: idDepartment,
        limit_date: limitDate,
        description,
        priority,
    }

    fetch(`/api/create/requests.php`, {
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
    fetch(`/api/read/requests.php`, {
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

    divTable.innerHTML += data;
}