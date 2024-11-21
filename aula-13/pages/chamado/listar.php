<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div style="width: 80%;">
        <h3>Todos os chamados</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Departamento</th>
                    <th>Usuário</th>
                    <th>Técnico</th>
                    <th>Data Limite</th>
                    <th>Prioridade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT r.id, d.name, u.username, r.description, r.priority, t.username AS technician, limit_date FROM requests AS r INNER JOIN departments AS d ON r.id_department = d.id INNER JOIN users AS u ON r.id_user = u.id INNER JOIN users AS t ON r.id_technician = t.id";
                $select = $database->prepare($sql);
                $select->execute();
                $counter = 0;
                ?>

                <?php while ($row = $select->fetch(PDO::FETCH_ASSOC)): ?>
                    <?php 
                    $priority = '';
                    $badgeClass = '';
                    switch($row['priority']) {
                        case 'L': $priority = 'Baixa';    $badgeClass = 'text-bg-secondary';  break;
                        case 'M': $priority = 'Média';    $badgeClass = 'text-bg-primary';    break;
                        case 'H': $priority = 'Alta';     $badgeClass = 'text-bg-warning';    break;
                        case 'U': $priority = 'Urgente';  $badgeClass = 'text-bg-danger';     break;
                    }

                    $limitDate = new DateTime($row['limit_date']);
                    ?>
                    <tr data-bs-toggle="collapse" data-bs-target="#description<?= $row['id']; ?>" aria-expanded="false">
                        <td><?= ++$counter; ?></td>
                        <td><?= ucfirst($row['name']); ?></td>
                        <td><?= ucfirst($row['username']); ?></td>
                        <td><?= ucfirst($row['technician']); ?></td>
                        <td><?= $limitDate->format('d/m/Y H:i'); ?></td>
                        <td><span class="badge <?= $badgeClass ?>"><?= $priority; ?></span></td>

                    </tr>
                    <tr class="collapse" id="description<?= $row['id']; ?>"> 
                        <td colspan=6" class="text-center"><?= $row['description'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <?php
                $sql = "SELECT COUNT(id) AS total FROM requests";
                $select = $database->prepare($sql);
                $select->execute();
                $allRows = $select->fetch(PDO::FETCH_ASSOC)['total'];
                ?>
                <tr class="text-end">
                    <td colspan="6"><strong>Total de registros encontrados: <?= $allRows ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>