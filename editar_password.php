<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'].'\Sistema_Gestao_Turistica\base_dados\basedados.h');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Editar Password</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>
<body class="sidebar-fixed header-fixed">
	<div class="page-wrapper">
		<nav class="navbar page-header">
			<a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
				<i class="fa fa-bars"></i>
			</a>

			<a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
				<i class="fa fa-bars"></i>
			</a>

			<a class="navbar-brand" href="index.php">
				<img src="./imgs/logo_sgt.png" alt="logo">
			</a>

			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="./imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">
						<?php
						$utilizador = $_SESSION['username'];
						echo "$utilizador";
						?>
						<span class="small ml-1 d-md-down-none"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-header">Account</div>

						<a href="gerir_perfil.php" class="dropdown-item active">
							<i class="fa fa-user"></i> Perfil
						</a>

						<div class="dropdown-header">Settings</div>

						<a href="logout.php" class="dropdown-item">
							<i class="fa fa-sign-out-alt"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</nav>

		<div class="main-container">
			<div class="sidebar">
				<nav class="sidebar-nav">
					<ul class="nav">
						<li class="nav-title">Menu</li>

						<li class="nav-item nav-dropdown">
							<a href="#" class="nav-link nav-dropdown-toggle" >
								<i class="icon icon-location-pin"></i> Ponto de Interesse <i class="fa fa-caret-left"></i>
							</a>

							<ul class="nav-dropdown-items">
								<li class="nav-item">
									<a href="gerir_pdi.php" class="nav-link">
										<i class="icon icon-location-pin"></i>Pontos de Interesse
									</a>
								</li>


								<li class="nav-item">
									<a href="./admin/gerir_tipo_pdi.php" class="nav-link">
										<i class="icon icon-tag"></i> Tipo de Ponto de Interesse
									</a>
								</li>

								<li class="nav-item">
									<a href="./admin/gerir_tipo_acessibilidade.php" class="nav-link">
										<i class="icon icon-graduation"></i> Tipo de Acessibilidade
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item">
							<a href="gerir_locais.php" class="nav-link">
								<i class="icon icon-home"></i> Locais
							</a>
						</li>                  

						<li class="nav-item">
							<a href="gerir_atracoes.php" class="nav-link">
								<i class="icon icon-camera"></i> Atrações Turísticas
							</a>
						</li>

						<li class="nav-item">
							<a href="gerir_rotas.php" class="nav-link">
								<i class="icon icon-map"></i> Rotas Turísticas
							</a>
						</li>

						<li class="nav-item">
							<a href="./admin/gerir_operadores.php" class="nav-link">
								<i class="icon icon-user"></i> Operadores Turísticos
							</a>
						</li>

					</ul>
				</nav>
			</div>

			<div class="content">
				<div class="col-md-6" >
					<form class="card"  method="POST" action="processa_editar_password.php">
						<div class="card-header bg-secondary">
							<b>Formulário de Alteração de Password</b>
						</div>

						<div class="card-actions">
							<a href="gerir_perfil.php" class="btn"> 
								<i class="fa fa-arrow-circle-left"></i> &nbsp; <b>Voltar</b>
							</a>

						</div>

						<div class="card-body" >
							<div class="row">
								<div class="col-md-12">
									<label for="required-input" class="require">Nova Password</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-key"></i></span>
										</div>
										<input name="password_nova" required id="password_nova" type="password" class="form-control" placeholder="Introduza a nova Password">
									</div>
								</div>

								<div class="col-md-12">
									<label for="required-input" class="require">Confirme Nova Passaword</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-key"></i></span>
										</div>
										<input name="password_conf" required id="password_conf" type="password" class="form-control" placeholder="Introduza novamente a nova Password">
									</div>
								</div>

								<div class="col-md-12">
									<label for="required-input" class="require">Password Atual</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-key"></i></span>
										</div>
										<input name="password_atual" required id="password_atual" type="password" class="form-control" placeholder="Introduza a Password atual">
									</div>
								</div>

							</div>

						</div>
						<button type="submit" name="submit" class="btn btn-block btn-outline-secondary btn-sm"><b>Editar</b></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
</body>
</html>