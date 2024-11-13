<?php 
session_start(); 
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom border-2">
	<div class="container-fluid">
		<a class="navbar-brand">
			<?= ((!empty($_SESSION['usuario'])) ? "Bem vindo " . ucfirst($_SESSION['usuario']) . "! <br><small>({$_SESSION['tipo_usuario']})</small>" : 'Sistema hospital' ); ?>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
			<?php if (isset($_SESSION['usuario'])): ?>
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Listagem
						</a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item <?= ($pgAtual == 'receitas') ? 'active' : '' ?>" href="receitas.php">Listar receitas</a></li>
							<li><a class="dropdown-item <?= ($pgAtual == 'receitas_pendentes') ? 'active' : '' ?>" href="receitas_pendentes.php">Listar receitas pendentes</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Cadastros
						</a>
						<ul class="dropdown-menu">
							<?php if ($_SESSION['tipo_usuario'] == 'Admin'): ?>
								<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_medico') ? 'active' : '' ?>" href="cadastrar_medico.php">Cadastrar medico</a></li>
								<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_enfermeiro') ? 'active' : '' ?>" href="cadastrar_enfermeiro.php">Cadastrar enfermeiro</a></li>
							<?php else: ?>
								<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_paciente') ? 'active' : '' ?>" href="cadastrar_paciente.php">Cadastrar paciente</a></li>
								<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_receita') ? 'active' : '' ?>" href="cadastrar_receita.php">Cadastrar receita</a></li>
							<?php endif; ?>
						</ul>
					</li>
				</ul>
				<a class="btn btn-danger" href="sair.php">Sair</a>
			<?php else: ?>
				<span></span>
				<div>
					<a class="btn btn-outline-primary" href="login_enfermeiro.php">Login enfermeiro</a>
					<a class="btn btn-outline-primary" href="login_medico.php">Login médico</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</nav>