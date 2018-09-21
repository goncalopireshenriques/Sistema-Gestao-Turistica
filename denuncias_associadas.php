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
	<title>Sistema de Gestão Turística - Denúncias Associadas</title>
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

						<?php
						$categoria = $_GET['categoria']; 

						if($categoria == 0)
						{
							?>
							<li class="nav-item nav-dropdown">
								<a href="#" class="nav-link nav-dropdown-toggle active" >
									<i class="icon icon-location-pin"></i> Ponto de Interesse <i class="fa fa-caret-left"></i>
								</a>

								<ul class="nav-dropdown-items">
									<li class="nav-item">
										<a href="gerir_pdi.php" class="nav-link active">
											<i class="fa fa-map-marker-alt"></i>Pontos de Interesse
										</a>
									</li>
									<?php
								}
								else
								{
									?>
									<li class="nav-item nav-dropdown">
										<a href="#" class="nav-link nav-dropdown-toggle" >
											<i class="icon icon-location-pin"></i> Ponto de Interesse <i class="fa fa-caret-left"></i>
										</a>

										<ul class="nav-dropdown-items">
											<li class="nav-item">
												<a href="gerir_pdi.php" class="nav-link ">
													<i class="fa fa-map-marker-alt"></i>Pontos de Interesse
												</a>
											</li>
											<?php
										}
										?>

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


								<?php
								if($categoria == 1)
								{
									?>
									<li class="nav-item">
										<a href="gerir_locais.php" class="nav-link active">
											<i class="icon icon-home"></i> Locais
										</a>
									</li>  
									<?php
								}
								else
								{
									?>    
									<li class="nav-item">
										<a href="gerir_locais.php" class="nav-link">
											<i class="icon icon-home"></i> Locais
										</a>
									</li> 
									<?php
								}

								if($categoria == 2)
								{
									?>
									<li class="nav-item">
										<a href="gerir_atracoes.php" class="nav-link active">
											<i class="icon icon-camera"></i> Atrações Turísticas
										</a>
									</li>
									<?php
								}
								else
								{
									?>
									<li class="nav-item">
										<a href="gerir_atracoes.php" class="nav-link">
											<i class="icon icon-camera"></i> Atrações Turísticas
										</a>
									</li>
									<?php
								}
								?>

								<li class="nav-item">
									<a href="gerir_rotas.php" class="nav-link">
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

										<b>Denúncias Associadas</b>

										<?php

										if($categoria == 0)
										{
											?>
											<div class="card-actions">
												<a href="gerir_pdi.php" class="btn">
													<i class="fa fa-arrow-circle-left"></i>&nbsp; <b>Voltar</b>
												</a>
											</div>
											<?php
										}
										if($categoria == 1)
										{
											?>
											<div class="card-actions">
												<a href="gerir_locais.php" class="btn">
													<i class="fa fa-arrow-circle-left"></i>&nbsp; <b>Voltar</b>
												</a>
											</div>
											<?php
										}
										if($categoria == 2)
										{
											?>
											<div class="card-actions">
												<a href="gerir_atracoes.php" class="btn">
													<i class="fa fa-arrow-circle-left"></i>&nbsp; <b>Voltar</b>
												</a>
											</div>
											<?php
										}
										?>

									</div>

									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped">
												<thead>
													<tr align="center">
														<th>ID</th>
														<th>Texto</th>
														<th>Username Autor</th>
														<th>Data</th>
														<th>Resposta</th>
														<th>Username Operador</th>
														<th>Data Resposta</th>
														<th>Responder</th>
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
												$id_pdi = $_GET['id_pdi']; 
												$comentario = "SELECT c.ID_Comentario, c.Texto, c.Resposta, c.Data_Resposta, c.Tipo, a.Data, ut.Username FROM comentario AS c INNER JOIN avaliacao AS a ON a.ID_Avaliacao = c.ID_Avaliacao INNER JOIN utilizadorturista AS ut ON ut.ID_Utilizador = a.ID_Utilizador INNER JOIN pdi AS p ON p.ID_PDI = a.ID_PDI WHERE p.ID_PDI = '$id_pdi' AND c.Tipo='1'"; 

												$query = mysqli_query($conn_bd, $comentario);
												while($row = mysqli_fetch_array($query))
												{
													$id_comentario = $row['ID_Comentario'];
													$operador="SELECT o.Username FROM operadorturistico AS o INNER JOIN operadorturistico_comentario AS ot ON ot.ID_OperadorTuristico=o.ID_OperadorTuristico WHERE ot.ID_Comentario='$id_comentario'";
													$query_operador = mysqli_query($conn_bd, $operador);
													$row2 = mysqli_fetch_array($query_operador);
													echo "<tr>";
													echo "<td align='center'>" .$row['ID_Comentario']. "</td>";
													echo "<td align='justify'>" .$row['Texto']. "</td>";
													echo "<td align='center'>" .$row['Username']. "</td>";  //username do utilizador que escreveu o comentario
													echo "<td align='center'>" .$row['Data']. "</td>";
													echo "<td align='justify'>" .$row['Resposta']. "</td>";
													echo "<td align='center'>" .$row2['Username']. "</td>";  //username do oeprador que respondeu ao comentario
													echo "<td align='center'>" .$row['Data_Resposta']. "</td>";				
													$tipo = $row['Tipo'];
													if($perfil == 0)
													{
														if(empty($row2['0']))
														{
															echo "<td><p align='center'><a href='resposta.php?id=$id_comentario&categoria=$categoria&id_pdi=$id_pdi&tipo=$tipo' class='btn btn-outline-success btn-sm'><i class='fa fa-comment-alt'></i></a></td>";	
														}
														else 
														{
															echo "<td></td>";
														}
													}
													if($perfil==1)
													{
														echo "<td><p align='center'><a href='resposta.php?id=$id_comentario&categoria=$categoria&id_pdi=$id_pdi&tipo=$tipo' class='btn btn-outline-success btn-sm'><i class='fa fa-comment-alt'></i></a></td>";	
														echo	"<td align='center'><a href='remover_comentario.php?id=$id_comentario&tipo=$tipo' class='btn btn-outline-danger btn-sm'><i class='fa fa-times'></i></a></td>";
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
