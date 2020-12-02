<?php

$nomeUsuario = "";
if (isset($_SESSION['usuario'])) {
	$registro = $_SESSION['usuario'];
	$nomeUsuario = $registro['nome'];
} else {
	echo "<script>alert('Acesso negado.'); location.href='login.php';</script>";
}
?>

<nav class="navbar navbar-expand-md navbar-dark navbar-expand bg-info">
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">

		<a class="navbar-brand" href="principal.php">Projeto-Web</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php if ($pagina == 'morador') {
														echo 'active';
													} ?>">
				<a class="nav-link" href="moradorTabela.php">Morador</a>
			</li>
			<li class="nav-item <?php if ($pagina == 'tipo') {
														echo 'active';
													} ?>">
				<a class="nav-link" href="tipoTabela.php">Tipo</a>
			</li>
			<li class="nav-item <?php if ($pagina == 'conta') {
														echo 'active';
													} ?>">
				<a class="nav-link" href="contaTabela.php">Conta</a>
			</li>
		</ul>
		<div class="form-inline my-2 my-lg-0">
			<a class="form-control mr-sm-2" readonly><?php echo $nomeUsuario; ?></a>
			<a class="btn btn-danger my-2 my-sm-0" href="loginEncerrar.php">Sair</a>
		</div>
	</div>
</nav>