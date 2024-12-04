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
    let image = document.getElementsByName('image')[0].files;
    let minimum_price = document.getElementsByName('minimum_price')[0].value;
    let formData = new FormData();
    let randomFileName = (Math.random() + 1).toString(36).substring(7);

    formData.append('name', name);
    formData.append('image', image[0], randomFileName + '.png');
    formData.append('minimum_price', minimum_price);

    fetch(`/api/create/items.php`, {
        method: 'POST',
        body: formData
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
    fetch(`/api/read/items.php`, {
        headers: {
            'Content-Type': 'text/html'
        },
        method: 'GET',
    })
    .then(response => response.text())
    .then((data) => {
        showItems(data);
    });

}

function showItems(data) {
    let div = document.getElementById('read');
    div.innerHTML = String(data);
    
    let bidButton = document.getElementById('bid');
    if (bidButton) {
        bidButton.addEventListener('click', () => {
            let formData = new FormData();
            formData.append('id', bidButton.dataset.id);

            fetch(`/api/read/bid.php`, {
                body: formData,
                method: 'POST',
            })
            .then(response => response.text())
            .then((data) => {
                div.innerHTML = String(data);
            });
        });
    }
}

function details() {

}