<nav class="navbar navbar-expand-sm bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sessão</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php if($pg_atual == 'primeira'): ?>
          <a class="nav-link active" aria-current="page" href="#">Iniciar sessão</a>
        <?php else: ?>
          <a class="nav-link" href="primeira.php">Iniciar sessão</a>
        <?php endif; ?>
        </li>
        <li class="nav-item">
        <?php if($pg_atual == 'mostra_usuario'): ?>
          <a class="nav-link active" aria-current="page" href="#">Mostra usuário</a>
        <?php else: ?>
          <a class="nav-link" href="mostra_usuario.php">Mostra usuário</a>
        <?php endif; ?>
        </li>
        <li class="nav-item">
        <?php if($pg_atual == 'sair'): ?>
          <a class="nav-link active" aria-current="page" href="#">Sair</a>
        <?php else: ?>
          <a class="nav-link" href="sair.php">Sair</a>
        <?php endif; ?>
        </li>
      </ul>
    </div>
  </div>
</nav>