<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?= ($pgAtual == 'novo') ? 'active' : '' ?>" href="novo.php">Novo produto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($pgAtual == 'mostra') ? 'active' : '' ?>" href="mostra.php">Mostrar produtos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="sair.php">Encerrar sessão</a>
        </li>
      </ul>
    </div>
  </div>
</nav>