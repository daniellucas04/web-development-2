<div class="container mt-5 d-flex justify-content-center align-items-center">
    <div>
        <?php 
        include 'api/database/connection.php';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            
            $sql = "SELECT username, password FROM users WHERE email = :email";
            $select = $database->prepare($sql);
            $select->execute(['email' => $data['email']]);
            $userData = $select->fetch(PDO::FETCH_ASSOC);
    
            if (!empty($userData)) {
                if (password_verify($data['password'], $userData['password'])) {
                    echo "<div class='alert alert-success'>Login efetuado com sucesso! Aguarde o redirecionamento...</div>";
                    $_SESSION['username'] = $userData['username'];
                    header('Location: inicio');
                } else {
                    echo "<div class='alert alert-danger'>Erro ao efetuar o login. Tente novamente!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>O E-mail <strong>{$data['email']}</strong> não foi encontrado. Tente novamente.</div>";
            }
        }
        ?>
        <form method="post">
            <div class="card" style="width:40rem;">
                <div class="card-body">
                    <h3 class="text-center">Login de usuário</h3>
                    <div class="row">
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
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col mt-2">
                        <button style="width:100%;" class="btn btn-primary">Iniciar sessão</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>