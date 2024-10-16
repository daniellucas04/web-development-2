<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?= ($pgAtual == 'produtos') ? 'active' : '' ?>" href="mostra_produtos.php">Mostrar produtos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($pgAtual == 'times') ? 'active' : '' ?>" href="mostra_times.php">Mostrar times</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($pgAtual == 'livros') ? 'active' : '' ?>" href="mostra_livros.php">Mostrar livros</a>
        </li>
      </ul>
    </div>
  </div>
</nav>