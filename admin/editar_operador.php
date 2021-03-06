<?php
session_start();
include("../base_dados/basedados.h");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Editar Dados de Operador Turístico</title>
	<link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="../vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../css/styles.css">
</head>

<?php
if(isset($_SESSION['username']) && isset($_SESSION['perfil']))
{

	$utilizador = $_SESSION['username'];
	$perfil = $_SESSION['perfil'];
}
else
{
	header("location:../login.html");		
}
?>

<body class="sidebar-fixed header-fixed">
	<div class="page-wrapper">
		<nav class="navbar page-header">
			<a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
				<i class="fa fa-bars"></i>
			</a>

			<a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
				<i class="fa fa-bars"></i>
			</a>

			<a class="navbar-brand" href="../index.php">
				<img src="../imgs/logo_sgt.png" alt="logo">
			</a>

			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="../imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">
						<?php
						echo "$utilizador";
						?>
						<span class="small ml-1 d-md-down-none"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-header">Conta</div>

						<a href="../gerir_perfil.php" class="dropdown-item">
							<i class="fa fa-user"></i> Perfil
						</a>

						<div class="dropdown-header">Definições</div>

						<a href="../logout.php" class="dropdown-item">
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
									<a href="../gerir_pdi.php" class="nav-link">
										<i class="fa fa-map-marker-alt"></i>Pontos de Interesse
									</a>
								</li>

								<li class="nav-item">
									<a href="gerir_tipo_pdi.php" class="nav-link">
										<i class="fa fa-tags"></i> Tipos de Ponto de Interesse
									</a>
								</li>

								<li class="nav-item">
									<a href="gerir_acessibilidade.php" class="nav-link">
										<i class="fa fa-wheelchair"></i>Acessibilidades
									</a>
								</li>

								<li class="nav-item">
									<a href="gerir_tipo_acessibilidade.php" class="nav-link">
										<i class="fa fa-tags"></i> Tipos de Acessibilidade
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item">
							<a href="../gerir_locais.php" class="nav-link">
								<i class="icon icon-home"></i> Locais
							</a>
						</li>                  

						<li class="nav-item">
							<a href="../gerir_atracoes.php" class="nav-link">
								<i class="icon icon-camera"></i> Atrações Turísticas
							</a>
						</li>

						<li class="nav-item">
							<a href="../gerir_rotas.php" class="nav-link">
								<i class="icon icon-map"></i> Rotas Turísticas
							</a>
						</li>

						<li class="nav-item">
							<a href="gerir_operadores.php" class="nav-link active" >
								<i class="icon icon-user"></i> Operadores Turísticos
							</a>
						</li>

					</ul>
				</nav>
			</div>

			<div class="content">
				<div class="col-md-10" >
					<form class="card"  method="POST" action="processa_editar_operador.php">
						<div class="card-header bg-secondary">
							<b>Dados de Perfil do Operador Turístico</b>
						</div>

						<div class="card-actions">
							<a href="gerir_operadores.php" class="btn"> 
								<i class="fa fa-arrow-circle-left"></i> &nbsp; <b>Voltar</b>
							</a>
						</div>

						<?php
						$username = $_GET['username'];
						$select_perfil="SELECT ID_OperadorTuristico, Nome, Contacto, Username, Email FROM operadorturistico WHERE Username='$username'";
						$perfil = mysqli_query($conn_bd, $select_perfil);
						$row = mysqli_fetch_array($perfil);
						?>

						<div class="card-body" >
							<div class="row">
								<div class="col-md-6">
									<label for="required-input" class="require">Nome</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-address-card"></i></span>
										</div>
										<input name="nome" required id="nome" type="text" class="form-control" placeholder="Introduza Nome" value="<?php echo $row["Nome"];?>">
									</div>
								</div>

								<div class="col-md-6">
									<label for="required-input" class="require">Username</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-user"></i></span>
										</div>
										<input name="username" required id="username" type="text" class="form-control" placeholder="Introduza Username" value="<?php echo $row["Username"];?>">
									</div>
								</div>

								<div class="col-md-6">
									<label for="required-input" class="require">Contacto</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-phone"></i></span>
										</div>
										<input name="contacto" required id="contacto" type="number" min="0" class="form-control" placeholder="Introduza Contacto" value="<?php echo $row["Contacto"];?>">
									</div>
								</div>

								<div class="col-md-6">
									<label for="required-input" class="require">Email</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-envelope"></i></span>
										</div>
										<input name="email" required id="email" type="email" class="form-control" placeholder="Introduza Email"  value="<?php echo $row["Email"];?>">
									</div>
								</div>

								<div class="col-md-6">
									<label for="required-input" class="form-control-label">Password</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-key"></i></span>
										</div>
										<input name="password"  id="password" type="password" class="form-control" placeholder="Introduza Password">
									</div>
								</div>

								<input type="hidden" name="id_operador" id='id_operador' value = "<?php echo $row["ID_OperadorTuristico"];?>"/>

							</div>                   

						</div>
						<button type="submit" name="submit" class="btn btn-block btn-outline-secondary btn-sm"><b>Editar</b></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/popper.js/popper.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/chart.js/chart.min.js"></script>
<script src="../js/carbon.js"></script>
<script src="../js/demo.js"></script>
</body>
</html>