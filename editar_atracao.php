<?php
session_start();
include("base_dados/basedados.h");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Editar Atração Turística</title>
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
							<a href="gerir_atracoes.php" class="nav-link active">
								<i class="icon icon-camera"></i> Atrações Turísticas
							</a>
						</li>

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
					<div class="col-md-12" >
						<form class="card"  method="POST" action="processa_editar_atracao.php" enctype="multipart/form-data">
							<div class="card-header bg-secondary">
								<b>Formulário de Edição de Atração Turística</b>
							</div>

							<?php
							$id_pdi = $_GET['id_pdi'];
							$select_atracao="SELECT p.Nome, p.Descricao, p.Latitude, p.Longitude, p.Localizacao, p.QR_Code, p.Audio, p.ID_Tipo_PDI, a.ID_Local FROM pdi AS p INNER JOIN atracao AS a ON (a.ID_PDI = p.ID_PDI) WHERE p.ID_PDI='$id_pdi'"; 
							
							$pdi = mysqli_query($conn_bd, $select_atracao);
							list ($nome, $descricao, $latitude, $longitude, $localizacao, $qr_code, $audio, $id_tipo_pdi, $id_local) = mysqli_fetch_row($pdi); 

							?>

							<div class="card-actions">
								<a href="gerir_atracoes.php" class="btn"> 
									<i class="fa fa-arrow-circle-left"></i> &nbsp; <b>Voltar</b>
								</a>
							</div>

							<div class="card-body" >
								<div class="row">
									<div class="col-md-3">
										<label for="required-input" class="require">Nome</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
											</div>
											<input name="nome" required id="nome" class="form-control" placeholder="Introduza Nome" value="<?php echo $nome;?>">
										</div>
									</div>

									<div class="col-md-3">
										<label for="required-input" class="require">Latitude</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-globe"></i></span>
											</div>
											<input name="latitude" required id="latitude" type="text" class="form-control" placeholder="Introduza Latitude" value="<?php echo $latitude;?>">
										</div>
									</div>

									<div class="col-md-3">
										<label for="required-input" class="require">Longitude</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-globe"></i></span>
											</div>
											<input name="longitude" required id="longitude" class="form-control" placeholder="Introduza Longitude" value="<?php echo $longitude;?>">
										</div>
									</div>

									<div class="col-md-3">
										<label for="normal-input" class="form-control-label">Localização</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-map-pin"></i></span>
											</div>
											<input name="localizacao" id="localizacao" class="form-control" placeholder="Introduza Localidade" value="<?php echo $localizacao;?>">
										</div>
									</div>

									<div class="col-md-4">
										<label for="required-input" class="form-control-label">QR Code</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-qrcode"></i></span>
											</div>
											<input type="file" accept="image/*" max="250" id="qr_code" name="qr_code" class="form-control" >
										</div>
									</div>

									<div class="col-md-4">
										<label for="required-input" class="form-control-label">Audio</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-audio-description"></i></span>
											</div>
											<input type="file" accept="audio/*" max="250" id="audio" name="audio" class="form-control">
										</div>
									</div>

									<div class="col-md-4">
										<label for="single-select">Tipo</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-tags"></i></span>
											</div>
											<?php
											//vai buscar todos os nomes
											$tipo="SELECT Nome FROM tipopdi ORDER BY Nome ASC";
											$query = mysqli_query($conn_bd, $tipo);
											$options = array();
											
											//vai buscar o nome concreto para comparar no select em baixo
											$nome_tipo_pdi="SELECT Nome FROM tipopdi WHERE ID_TipoPDI = '$id_tipo_pdi'";
											$query_nome = mysqli_query($conn_bd, $nome_tipo_pdi);
											$row = mysqli_fetch_assoc($query_nome);
											
											
											while($row2 = mysqli_fetch_array($query))
											{
												//mete na variavel options o array de todos os nomes do tipopdi
												$options[] = $row2['Nome'];
											}
											?>
											
											
											<select name="tipo_pdi" id="tipo_pdi" class="form-control">
												<?php foreach ($options as $option): ?>
													<option value="<?php echo $option; ?>"<?php if ($row['Nome'] == $option): ?> selected='selected'<?php endif; ?>>
														<?php echo $option; ?>
													</option>
												<?php endforeach; ?>
											</select>
											
										</div>
									</div>

									<div class="col-md-4">
										<label for="required-input" class="form-control-label">Imagem</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-file-image"></i></span>
											</div>
											<input type="file" accept="image/*" max="250" id="imagem" name="imagem" class="form-control">
										</div>
									</div>

									<div class="col-md-4">
										<label for="required-input" class="form-control-label">Legenda da Imagem</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-comment-alt"></i></span>
											</div>
											<input name="legenda" id="legenda" type="text" class="form-control" placeholder="Introduza Legenda">
										</div>
									</div> 

									<div class="col-md-4">
										<label for="textarea">Descrição</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-align-justify"></i></span>
											</div>
											<textarea name="descricao" id="descricao" class="form-control" rows="1"><?php echo $descricao;?></textarea>
										</div>
									</div>

									<div class="col-md-4">
										<label for="single-select">Local Associado</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fa fa-tags"></i></span>
											</div>
											<?php
											//vai buscar todos os nomes
											$nome_locais="SELECT Nome FROM pdi WHERE ID_PDI IN (SELECT ID_PDI FROM local) ORDER BY NOME ASC";
											$query = mysqli_query($conn_bd, $nome_locais);
											$options = array();
											
											//mete na variavel options o array de todos os nomes do local
											while($row2 = mysqli_fetch_array($query)){

												$options[] = $row2['Nome'];
											}
											
											$nome_local_associado="	SELECT Nome FROM pdi AS p INNER JOIN local AS l ON l.ID_PDI = p.ID_PDI WHERE ID_Local = '$id_local'";
											$query_nome_local = mysqli_query($conn_bd, $nome_local_associado);
											$row_local = mysqli_fetch_assoc($query_nome_local);
											
											?>
											<select name="local_associado" id="local_associado" class="form-control">
												<?php foreach ($options as $option): ?>
													<option value="<?php echo $option; ?>"<?php if ($row_local['Nome'] == $option): ?> selected='selected'<?php endif; ?>>
														<?php echo $option; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<input type="hidden" id="id_pdi" name="id_pdi" value="<?php echo $id_pdi; ?>">

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