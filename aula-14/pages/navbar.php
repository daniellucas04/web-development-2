<?php 
session_start(); 
include 'api/database/connection.php';
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-2">
	<div class="container-fluid">
		<a class="navbar-brand">
			<?= ((!empty($_SESSION['username'])) ? "Leilão<br><small>Bem vindo " . ucfirst($_SESSION['username']) . "!</small>" : 'Leilão' ); ?>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item"><a href="/" class="btn btn-outline-primary">Página inicial</a></li>	
			</ul>
			<?php if (!empty($_SESSION) AND isset($_SESSION['username'])): ?>
				<a class="btn btn-danger" href="/sair.php">Sair</a>
			<?php endif; ?>
		</div>
	</div>
</nav>