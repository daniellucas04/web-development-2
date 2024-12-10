<?php 
include '../database/connection.php';
session_start();

$id = $_POST['id'];
$sql = "SELECT * FROM items WHERE id = :id";
$select = $database->prepare($sql);
$select->execute(['id' => $id]);
$row = $select->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5 d-flex justify-content-center align-items-center flex-column gap-3">
    <div id="result"></div>
    <div class="card" style="width:20rem; height:15rem;">
        <div class="card-body">
            <h3 class="text-center">Fazer lance</h3>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><ion-icon name="cash-outline"></ion-icon></span>
                        <input type="text" class="form-control" placeholder="Valor do lance" name="bid_price" required>
                    </div>
                </div>
                <div>
                    <input type="hidden" name="id_item" value="<?= $row['id']; ?>">
                    <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col mt-2">
                <button style="width:100%;" id="makeBid" class="float-end btn btn-primary">Realizar lance</button>
            </div>
        </div>
    </div>
    <div class="text-center border border-2 rounded" style="width:20rem;height:20rem;">
        <img src="../../images/<?= "{$row['id']}/{$row['image']}"?>" class="mt-2" style="height:10rem;width:10rem;">
        <div class="d-flex justify-content-center flex-column align-items-center">
            <h5 class="text-center mt-3"><?= $row['name']; ?></h5>
            <?php 
            $sql = "SELECT bid_price FROM bids WHERE id_item = :id_item ORDER BY bid_timestamp DESC LIMIT 1";
            $select = $database->prepare($sql);
            $select->execute(['id_item' => $id]);

            $showPrice = ($select->rowCount() > 0) ? $select->fetch(PDO::FETCH_ASSOC)['bid_price'] : $row['minimum_price'];
            $showPrice = str_replace('.', ',', $showPrice);
            ?>
            <small>Preço mínimo atual:</small>
            <p class="bg-success text-white rounded p-2" style="width:12rem;"><strong>R$<?= $showPrice; ?></strong></p>
        </div>
    </div>
</div>
<script src="../../api/scripts/items.js"></script>