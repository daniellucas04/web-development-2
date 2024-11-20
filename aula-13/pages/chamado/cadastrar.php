<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <div id="result"></div>
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3 class="text-center">Cadastrar chamado</h3>
                <div class="row">
                    <?php
                    $sql = "SELECT id, name FROM departments";
                    $selectDepartments = $database->prepare($sql);
                    $selectDepartments->execute();

                    $sql = "SELECT id, username FROM users WHERE is_tech = :is_tech";
                    $selectTechnicians = $database->prepare($sql);
                    $selectTechnicians->execute(['is_tech' => 'T']);
                    ?>
                    <div class="col-12 mt-2">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="id_department" id="id_department" required>
                                <option value="" disabled selected>Selecione um departamento</option>
                                <?php while ($linha = $selectDepartments->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $linha['id'] ?>"><?= $linha['name'] ?></option>
                                    <?php endwhile ?>
                                </select>
                            <label for="id_department">Departamento</label>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" style="height: 100px" name="description" id="description" required></textarea>
                            <label for="description">Descrição</label>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="priority" id="priority" required>
                                <option value="L">Baixa</option>
                                <option value="M">Média</option>
                                <option value="H">Alta</option>
                                <option value="U">Urgente</option>
                                </select>
                            <label for="priority">Prioridade</label>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="id_technician" id="id_technician" required>
                                <option value="" disabled selected>Selecione um técnico</option>
                                <?php while ($linha = $selectTechnicians->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?= $linha['id'] ?>"><?= ucfirst($linha['username']) ?></option>
                                    <?php endwhile ?>
                                </select>
                            <label for="id_technician">Técnico</label>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="datetime-local" name="limit_date" id="priority">
                            <label for="priority">Data e Hora limite</label>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" value="<?= $_SESSION['id_user'] ?>" name="id_user">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col mt-2">
                    <button id="create" class="float-end btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../api/scripts/requests.js"></script>