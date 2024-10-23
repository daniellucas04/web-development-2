<nav class="navbar navbar-expand-lg bg-body-tertiary">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Menu</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Listar
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?= ($pgAtual == 'listar_turmas') ? 'active' : '' ?>" href="listar_turmas.php">Listar turmas</a></li>
						<li><a class="dropdown-item <?= ($pgAtual == 'listar_alunos') ? 'active' : '' ?>" href="listar_alunos.php">Listar alunos</a></li>
						<li><a class="dropdown-item <?= ($pgAtual == 'listar_alunos_turma') ? 'active' : '' ?>" href="listar_alunos_turma.php">Listar alunos de uma turma</a></li>
						<li><a class="dropdown-item <?= ($pgAtual == 'listar_aluno_notas') ? 'active' : '' ?>" href="listar_aluno_notas.php">Listar notas de uma aluno</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Cadastros
					</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_turma') ? 'active' : '' ?>" href="cadastrar_turma.php">Cadastrar turma</a></li>
						<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_aluno') ? 'active' : '' ?>" href="cadastrar_aluno.php">Cadastrar aluno</a></li>
						<li><a class="dropdown-item <?= ($pgAtual == 'cadastrar_nota') ? 'active' : '' ?>" href="cadastrar_nota.php">Cadastrar nota</a></li>
					</ul>
				</li>			
			</ul>
		</div>
	</div>
</nav>