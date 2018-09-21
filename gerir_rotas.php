<?php
session_start();
include("base_dados/basedados.h");
?>
<!doctype HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Gerir Rotas</title>
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
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-secondary">
								
								<b>Rotas Turísticas</b>

								<div class="card-actions">

									<a href="gerir_rotas.php" class="btn">
										<i class="fa fa-retweet"></i> &nbsp;
									</a>

									<a>
										<form action="gerir_rotas.php" method="post">
											<input type="text" name="valorParaPesquisar" placeholder="Pesquisar">
											<input type="submit" name="pesquisa" value="Filtrar">
										</form>
									</a>

									<a href="index.php" class="btn">
										<i class="fa fa-arrow-circle-left"></i>&nbsp; <b>Voltar</b>
									</a>

									<a href="adicionar_rota.php" class="btn">
										<i class="fa fa-plus-square"></i>&nbsp; <b>Adicionar</b>
									</a>
								</div>
							</div>

							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr align="center">
												<th>ID</th>
												<th>Nome</th>
												<th>Descrição</th>
												<th>Duracao</th>
												<th>Ordem</th>
												<th>Pontos de Interesse Associados</th>
												<th>Editar</th>
												<?php
												if($perfil==1)
												{
													?>
													<th>Remover</th>
													<?php
												}
												?>
											</tr>
										</thead>

										<?php
										if(isset($_POST['pesquisa']))
										{
											$valorParaPesquisar = $_POST['valorParaPesquisar'];
											$query = "SELECT * FROM rota WHERE CONCAT(ID_Rota, Nome, Descricao, Duracao, Ordem) LIKE '%".$valorParaPesquisar."%'";
											$resultado_pesquisa = mysqli_query($conn_bd, $query); 
										}
										else
										{
											$query = "SELECT * FROM rota";
											$resultado_pesquisa = mysqli_query($conn_bd, $query);
										}

										while($row = mysqli_fetch_array($resultado_pesquisa)){
											echo "<tr>";
											echo "<td align='center'>" .$row['ID_Rota']. "</td>";
											echo "<td align='center'>" .$row['Nome']. "</td>";
											echo "<td align='justify'>" .$row['Descricao']. "</td>";
											echo "<td align='center'>" .date("H:i",strtotime($row['Duracao']))." h","</td>";
											echo "<td align='center'>" .$row['Ordem']. "</td>";
											$id_rota = $row['ID_Rota'];
											echo "<td align='center'><a href='pdis_associados.php?id_rota=$id_rota' class='btn btn-outline-success btn-sm'><i class='fa fa-map-marker-alt'></i></a></td>";	
											echo "<td align='center'><a href='editar_rota.php?id_rota=$id_rota' class='btn btn-outline-warning btn-sm'><i class='fa fa-pencil-alt'></i></a></td>";
											if($perfil==1)
											{	
												echo	"<td align='center'><a href='./admin/remover_rota.php?id_rota=$id_rota' class='btn btn-outline-danger btn-sm'><i class='fa fa-times'></i></a></td>";
											}
										}
										?>
									</table>
								</div>
							</div>
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
