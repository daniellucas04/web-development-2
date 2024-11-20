<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <div id="result"></div>
        <div class="card" style="width:40rem;">
            <div class="card-body">
                <h3 class="text-center">Cadastrar usuário</h3>
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="person-circle-outline"></ion-icon></span>
                            <input type="text" class="form-control" placeholder="Usuário" name="username">
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="mail-outline"></ion-icon></span>
                            <input type="email" class="form-control" placeholder="E-mail" name="email">
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><ion-icon name="shield-half-outline"></ion-icon></span>
                            <input type="password" class="form-control" placeholder="Senha" name="password">
                        </div>
                    </div>
                    <div class="col mt-2">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" placeholder="Senha" name="tech">
                            <label class="form-check-label">Técnico</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col mt-2">
                    <button style="width:100%;" id="create" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../api/scripts/users.js"></script>