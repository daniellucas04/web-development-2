<?php include '../database/connection.php' ?>
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <script>
        window.onload = () => {
            let detailsButton = document.getElementById('detailsButton');
        }
    </script>
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
                $sql = "SELECT id, name, minimum_price, image, status FROM items WHERE status = :status";
                $select = $database->prepare($sql);
                $select->execute(['status' => 'T']);
                $counter = 0;
                ?>

                <?php while ($row = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php 
                    $badgeClass = $badgeText = '';
                    switch ($row['status']) {
                        case 'T': $badgeClass = 'text-bg-success'; $badgeText = 'Aberto'; break;
                    }    
                    ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#details<?= $row['id']; ?>" aria-expanded="false" >
                        <td><?= ++$counter;  ?></td>
                        <td><?= ucfirst($row['name']);  ?></td>
                        <td>R$<?= str_replace('.', ',', $row['minimum_price']) ?></td>
                        <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                    </tr>
                    <tr class="collapse" id="details<?= $row['id']; ?>">
                        <td colspan="5">
                            <div class="d-flex align-items-center justify-content-evenly gap-3">
                                <div class="d-flex gap-3">
                                    <img src="../../images/<?= "{$row['id']}/{$row['image']}" ?>" class="img-fluid" width="210px" height="210px">
                                    <div class="mt-5">
                                        <h5 class="text-center"><strong><?= strtoupper($row['name']) ?></strong></h5>
                                        <p class="text-center bg-success rounded text-white p-2"><strong>R$<?= str_replace('.', ',', $row['minimum_price']) ?></strong></p>
                                    </div>
                                </div>
                                <div>
                                    <button id="bid" data-id="<?= $row['id']; ?>" class="btn btn-primary">Fazer lance</a>
                                </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php
                $sql = "SELECT COUNT(id) AS total FROM items";
                $select = $database->prepare($sql);
                $select->execute();
                $allRows = $select->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr class="text-end">
                    <td colspan="5"><strong>Total de registros encontrados: <?= $allRows ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>