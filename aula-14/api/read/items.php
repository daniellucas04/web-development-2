<?php include '../database/connection.php' ?>
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div style="width: 80%;">
        <h3>Todos os itens</h3>
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
                <?php
                $sqlItems = "SELECT id, name, minimum_price, image, status, id_auctioneer FROM items WHERE status = :status";
                $selectItems = $database->prepare($sqlItem);
                $selectItems->execute(['status' => 'T']);
                $counter = 0;
                ?>

                <?php while ($itemsRow = $selectItems->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php 
                    $badgeClass = $badgeText = '';
                    switch ($itemsRow['status']) {
                        case 'T': $badgeClass = 'text-bg-success'; $badgeText = 'Aberto'; break;
                    }    
                    ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#details<?= $itemsRow['id']; ?>" aria-expanded="false" >
                        <td><?= ++$counter;  ?></td>
                        <td><?= ucfirst($itemsRow['name']); ?></td>
                        <td>R$<?= str_replace('.', ',', $itemsRow['minimum_price']) ?></td>
                        <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                    </tr>
                    <tr class="collapse" id="details<?= $itemsRow['id']; ?>">
                        <td colspan="5">
                            <div class="d-flex gap-5 align-items-center justify-content-evenly">
                                <?php 
                                $sql = "SELECT b.bid_price, u.username FROM bids AS b INNER JOIN users AS u ON b.id_user = u.id WHERE id_item = :id ORDER BY bid_timestamp DESC LIMIT 4";
                                $select = $database->prepare($sql);
                                $select->execute(['id' => $row['id']]);
                                ?>
                                <?php ?>
                                <div style="width:10rem;">
                                    <ul class="list-group">
                                        <?php while ($bidRow = $select->fetch(PDO::FETCH_ASSOC)): ?>
                                            <li class="list-group-item"><?= ucfirst($bidRow['username']) ?> - <strong>R$<?= str_replace('.', ',', $bidRow['bid_price']) ?></strong></li>
                                        <?php endwhile ?>
                                    </ul>
                                    <h5 class="text-center mt-1">Últimos lances</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column gap-2">
                                    <div>
                                        <img src="../../images/<?= "{$itemsRow['id']}/{$itemsRow['image']}" ?>" class="img-fluid border border-2 rounded" width="150px" height="150px">
                                    </div>
                                    <div>
                                        <button id="bid" style="width:100%;" data-id="<?= $itemsRow['id']; ?>" class="btn btn-primary">Fazer lance</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php
                $sql = "SELECT COUNT(id) AS total FROM items WHERE status = :status";
                $select = $database->prepare($sql);
                $select->execute(['status' => 'T']);
                $allRows = $select->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr class="text-end">
                    <td colspan="5"><strong>Total de registros encontrados: <?= $allRows ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>