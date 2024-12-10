<?php $idUser = $_SESSION['id_user']; ?>
<div class="container d-flex justify-content-center mt-5">
    <div style="width: 80%;">
        <div id="result"></div>
        <h3 class="mb-4">Itens vencidos</h3>
        <?php
        $sqlItems = "SELECT id, name, minimum_price, image, status, winner FROM items WHERE winner = :id";
        $selectItems = $database->prepare($sqlItems);
        $selectItems->execute(['id' => $idUser]);
        $counter = 0;

        if ($selectItems->rowCount() > 0):
        ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Valor mínimo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($itemRow = $selectItems->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php 
                    $badgeClass = $badgeText = '';
                    switch ($itemRow['status']) {
                        case 'T': $badgeClass = 'text-bg-success'; $badgeText = 'Aberto'; break;
                        case 'F': $badgeClass = 'text-bg-secondary'; $badgeText = 'Finalizado'; break;
                    }    
                    ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#details<?= $itemRow['id']; ?>" aria-expanded="false" >
                        <td><?= ++$counter;  ?></td>
                        <td><?= ucfirst($itemRow['name']); ?></td>
                        <td>R$<?= str_replace('.', ',', $itemRow['minimum_price']) ?></td>
                        <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                    </tr>
                    <tr class="collapse" id="details<?= $itemRow['id']; ?>">
                        <td colspan="5">
                            <div class="d-flex gap-5 align-items-center justify-content-evenly">
                                <?php 
                                $sqlBids = "SELECT b.bid_price FROM bids AS b INNER JOIN users AS u ON b.id_user = u.id WHERE id_item = :id ORDER BY bid_timestamp DESC LIMIT 4";
                                $selectBids = $database->prepare($sqlBids);
                                $selectBids->execute(['id' => $itemRow['id']]);
                                ?>
                                <?php ?>
                                <div style="width:14rem;">
                                    <?php while ($bidRow = $selectBids->fetch(PDO::FETCH_ASSOC)): ?>
                                        <h4 class="text-center">Você comprou este item por <br> R$<?= str_replace('.', ',', $bidRow['bid_price']); ?></h4>
                                    <?php endwhile ?>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column gap-2">
                                    <div>
                                        <img src="../../images/<?= "{$itemRow['id']}/{$itemRow['image']}" ?>" class="img-fluid border border-2 rounded" width="150px" height="150px">
                                    </div>
                                    <?php if ($itemRow['status'] != 'F'): ?>
                                    <div>
                                        <button id="finishBid" class="btn btn-primary">Finalizar leilão</button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div>
                        <input type="hidden" name="id_item" value="<?= $itemRow['id']; ?>">
                    </div>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php
                $sql = "SELECT COUNT(id) AS total FROM items WHERE id_auctioneer = :id";
                $select = $database->prepare($sql);
                $select->execute(['id' => $idUser]);
                $allRows = $select->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr class="text-end">
                    <td colspan="5"><strong>Total de registros encontrados: <?= $allRows ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <?php else: ?>
            <span class="alert alert-info d-flex justify-content-center"><strong>Oooops! Não foram encontrados itens vencidos por você.</strong></span>
        <?php endif; ?>
    </div>
</div>
<script src="../../api/scripts/items.js"></script>