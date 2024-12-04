<?php include '../database/connection.php'; ?>
<?php $id = $_POST['id']; ?>
<div class="container mt-5 d-flex justify-content-center">
    <div>
        <div id="result"></div>
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3 class="text-center">Fazer lance</h3>
                <?php 
                $sql = "SELECT * FROM items WHERE id = :id";
                $select = $database->prepare($sql);
                $select->execute(['id' => $id]);
                $select->fetch(PDO::FETCH_ASSOC)
                ?>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="pricetags-outline"></ion-icon></ion-icon></span>
                            <input type="text" class="form-control" placeholder="Nome" name="bid_price" required>
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