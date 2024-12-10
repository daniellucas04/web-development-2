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

    let finishBidButton = document.getElementById('finishBid');
    if (finishBidButton) {
        finishBidButton.addEventListener('click', () => {
            finishBid();
        });
    }
}

function create() {
    // Campos para registro da administração
    let name = document.getElementsByName('name')[0].value;
    let image = document.getElementsByName('image')[0].files;
    let minimum_price = document.getElementsByName('minimum_price')[0].value;
    let id_auctioneer = document.getElementsByName('id_auctioneer')[0].value; 

    let formData = new FormData();
    let randomFileName = (Math.random() + 1).toString(36).substring(7);

    formData.append('name', name);
    formData.append('image', image[0], randomFileName + '.png');
    formData.append('minimum_price', minimum_price);
    formData.append('id_auctioneer', id_auctioneer);

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
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then((data) => {
                div.innerHTML = String(data);
                makeBid();
            });
        });
    }
}

function makeBid() {
    let makeBidButton = document.getElementById('makeBid');
    if (makeBidButton) {
        makeBidButton.addEventListener('click', () => {
            let bid_price = document.getElementsByName('bid_price')[0].value;
            let id_user = document.getElementsByName('id_user')[0].value; 
            let id_item = document.getElementsByName('id_item')[0].value; 

            let formData = new FormData();
            formData.append('bid_price', bid_price);
            formData.append('id_user', id_user);
            formData.append('id_item', id_item);

            fetch('/api/create/bid.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then((data) => {
                showResult(data);
            })
        });
    }
}

function finishBid() {
    let id_item = document.getElementsByName('id_item')[0].value;

    fetch(`/api/update/items.php?id=${id_item}`, {
        method: 'GET',
    })
    .then(response => response.json())
    .then((data) => {
        showResult(data);
    })

    location.reload();
}