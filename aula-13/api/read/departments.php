<?php include '../database/connection.php' ?>
<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div style="width: 80%;">
        <h3>Todos os departamentos</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT name FROM departments";
                $select = $database->prepare($sql);
                $select->execute();
                $counter = 0;
                ?>

                <?php while ($row = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= ++$counter;  ?></td>
                        <td><?= ucfirst($row['name']);  ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php
                $sql = "SELECT COUNT(id) AS total FROM departments";
                $select = $database->prepare($sql);
                $select->execute();
                $allRows = $select->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr class="text-end">
                    <td colspan="2"><strong>Total de registros encontrados: <?= $allRows ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>