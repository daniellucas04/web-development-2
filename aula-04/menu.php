<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?= ($pg_atual == 'formulario') ? 'active' : '' ?>" href="formulario.php">Formulário</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($pg_atual == 'mostra') ? 'active' : '' ?>" href="mostra.php">Mostra</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($pg_atual == 'mostra_idade') ? 'active' : '' ?>" href="mostra_idade.php">Mostra idade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="sair.php">Encerrar sessão</a>
        </li>
      </ul>
    </div>
  </div>
</nav>