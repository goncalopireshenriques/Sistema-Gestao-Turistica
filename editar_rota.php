<?php
session_start();
include("base_dados/basedados.h");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Editar Rota Turística</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>

<?php
if(isset($_SESSION['username']) && isset($_SESSION['perfil']))
{
	$utilizador = $_SESSION['username'];
	$perfil = $_SESSION['perfil'];
}
else
{
	header("location:login.html");		
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

			<a class="navbar-brand" href="index.php">
				<img src="./imgs/logo_sgt.png" alt="logo">
			</a>

			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="./imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">
						<?php
						echo "$utilizador";
						?>
						<span class="small ml-1 d-md-down-none"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-header">Conta</div>

						<a href="gerir_perfil.php" class="dropdown-item">
							<i class="fa fa-user"></i> Perfil
						</a>

						<div class="dropdown-header">Definições</div>

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
										<i class="fa fa-map-marker-alt"></i>Pontos de Interesse
									</a>
								</li>

								<?php
								if($perfil==1)
								{
									?>
									<li class="nav-item">
										<a href="./admin/gerir_tipo_pdi.php" class="nav-link">
											<i class="fa fa-tags"></i> Tipos de Ponto de Interesse
										</a>
									</li>

									<li class="nav-item">
										<a href="./admin/gerir_acessibilidade.php" class="nav-link">
											<i class="fa fa-wheelchair"></i> Acessibilidades
										</a>
									</li>

									<li class="nav-item">
										<a href="./admin/gerir_tipo_acessibilidade.php" class="nav-link">
											<i class="fa fa-tags"></i> Tipos de Acessibilidade
										</a>
									</li>
									<?php
								}
								?>

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
							<a href="gerir_rotas.php" class="nav-link active">
								<i class="icon icon-map"></i> Rotas Turísticas
							</a>
						</li>

						<?php
						if($perfil==1)
						{
							?>
							<li class="nav-item">
								<a href="./admin/gerir_operadores.php" class="nav-link">
									<i class="icon icon-user"></i> Operadores Turísticos
								</a>
							</li>
							<?php
						}
						?>
						
					</ul>
				</nav>
			</div>

			<div class="content">
				<div class="row">
					<div class="col-md-8" >
						<form class="card"  method="POST" action="processa_editar_rota.php">
							<div class="card-header bg-secondary">
								<b>Formulário de Edição de Rota </b>
							</div>

							<?php
							$id_rota = $_GET['id_rota'];
							$select_rota="SELECT ID_Rota, Nome, Descricao, Duracao, Ordem FROM rota WHERE ID_Rota='$id_rota'";
							$rota = mysqli_query($conn_bd, $select_rota);
							list($ID_Rota, $Nome, $Descricao, $Duracao, $Ordem) = mysqli_fetch_row($rota); 

							?>

							<div class="card-actions">
								<a href="gerir_rotas.php" class="btn"> 
									<i class="fa fa-arrow-circle-left"></i> &nbsp; <b>Voltar</b>
								</a>
							</div>

							<div class="card-body" >
								<div class="row">
										<div class="col-md-6">
										<label for="required-input" class="require">Nome</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map"></i></span>
											</div>
											<input name="nome" required id="nome" class="form-control" placeholder="Introduza Nome" value="<?php echo $Nome;?>">
										</div>
									</div>

									<div class="col-md-3">
										<label for="required-input" class="require">Duração</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-clock"></i></span>
											</div>
											<input type="time" name="duracao" required id="duracao" class="form-control" placeholder="Introduza Duração" value="<?php echo date("H:i",strtotime($Duracao));?>">
										</div>
									</div>

									<div class="col-md-6">
										<label for="textarea">Descrição</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-align-justify"></i></span>
											</div>
											<textarea name="descricao" id="descricao" class="form-control" rows="3"><?php echo $Descricao;?></textarea>
										</div>
									</div>
									
									<div class="col-md-6">
										<label for="textarea" class="require">Ordem</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map-signs"></i></span>
											</div>
											<textarea name="ordem" required id="ordem" class="form-control" rows="3" ><?php echo $Ordem;?></textarea>
										</div>
									</div>

									<input type="hidden" name="id_rota" maxlength="11" value = "<?php echo $id_rota?>"/>

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