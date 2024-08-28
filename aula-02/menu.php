<?php
include 'atual.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Barra</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($pg_atual == 'home') ? 'active' : '' ?>" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($pg_atual == 'produtos') ? 'active' : '' ?>" href="produtos.php">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($pg_atual == 'carrinho') ? 'active' : '' ?>" href="carrinho.php">Carrinho</a>
        </li>
          </ul>
        </div>
      </div>
    </nav>
</body>
</html>