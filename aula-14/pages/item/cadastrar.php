<div class="container mt-5 d-flex justify-content-center">
    <div>
        <div id="result"></div>
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3 class="text-center">Cadastrar item</h3>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="pricetags-outline"></ion-icon></ion-icon></span>
                            <input type="text" class="form-control" placeholder="Nome" name="name" required>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <input type="file" accept=".png, .jpg" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="cash-outline"></ion-icon></span>
                            <input type="text" class="form-control" placeholder="Preço mínimo" name="minimum_price" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col mt-2">
                    <button style="width:100%;" id="create" class="float-end btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../api/scripts/items.js"></script>