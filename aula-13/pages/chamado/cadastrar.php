<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <div id="result"></div>
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3 class="text-center">Cadastrar chamado</h3>
                <div class="row">
                    <?php
                    $sql = "SELECT id, name FROM departments";
                    $select = $database->prepare($sql);
                    $select->execute();
                    ?>
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <select class="form-select">
                                <?php while ($linha = $select->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $linha['id'] ?>"><?= $linha['name'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col mt-2">
                    <button id="create" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../api/scripts/departments.js"></script>