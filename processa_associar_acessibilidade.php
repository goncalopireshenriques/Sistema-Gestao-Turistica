<link rel="stylesheet" type="text/css" href="css/styles.css">
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
	<title>Sistema de Gestão Turística - Processa Associar Acessibilidade</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>
<body>
	<div class="page-wrapper flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card bg-dark">
						<div class="card-body">
							<?php
							if (isset($_SESSION['username']) && $_SESSION['perfil'] == '1' || $_SESSION['perfil'] == '0')
							{
								$id_pdi = $_SESSION['id_pdi'];
								$categoria = $_SESSION['categoria'];
								$acessibilidade = $_POST['acessibilidade'];
								foreach ($acessibilidade as $acessibilidade){
									$select_id ="SELECT ID_Acessibilidade FROM acessibilidade WHERE Nome='$acessibilidade'";
									$query_id = mysqli_query($conn_bd, $select_id); // id correspondente ao nome do tipo de acessibilidade escolhido

									while($row = mysqli_fetch_array($query_id)){
										$id = $row['ID_Acessibilidade'];
										$insert_tipo="INSERT INTO pdi_acessibilidade (ID_PDI, ID_Acessibilidade) VALUES ('$id_pdi', '$id')";
										if(mysqli_query($conn_bd, $insert_tipo))
										{
											?>
											<div class="card-header bg-dark" align="center">
												<font color="#fff" size="6">Sucesso</font>
											</div>
											<div class="alert alert-success p-5" align="center">
												<font color="#444" size="6">Acessibilidade associada com sucesso!</font>
												<?php
												header("refresh:1;url=acessibilidade_associada.php?id_pdi=$id_pdi&categoria=$categoria");
												?>
											</div>
											<?php
										}
										else
										{
											?>
											<div class="card-header bg-dark" align="center">
												<font color="#fff" size="6">Erro</font>
											</div>
											<div class="alert alert-danger p-5" align="center">
												<font color="#444" size="6">Erro ao associar Acessibilidade!</font>
												<?php
												header("refresh:1;url=acessibilidade_associada?id_pdi=$id_pdi.php&categoria=$categoria");
												?>
											</div>
											<?php
										}
									}
								}
							}
							else
							{
								?>
								<div class="card-header bg-dark" align="center">
									<font color="#fff" size="6">Aviso</font>
								</div>
								<div class="alert alert-warning p-5" align="center">
									<font color="#444" size="6">Efetue Login!</font>
									<?php
									header("refresh:2;url=login.html");
									?>
								</div>
								<?php
							}

							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
