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
	<title>Sistema de Gestão Turística - Processa Adicionar Rota Turística</title>
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
							if (isset($_SESSION['username']) && $_SESSION['perfil'] == '1' || $_SESSION['perfil'] == '0' )
							{

								$nome = $_POST['nome'];
								$duracao = $_POST['duracao'];
								$descricao = $_POST['descricao'];
								$ordem = $_POST['ordem'];

								$insert_rota = "INSERT INTO rota (Nome, Descricao, Duracao, Ordem)
								VALUES ('$nome','$descricao', '$duracao', '$ordem')";

								$Nome_PDI = $_POST['pdi'];

								if(mysqli_query($conn_bd, $insert_rota))
								{	
									$ID_Rota = mysqli_insert_id($conn_bd);
									foreach ($Nome_PDI as $nome){
										$select_id ="SELECT ID_PDI FROM pdi WHERE Nome='$nome'";
										$query_id = mysqli_query($conn_bd, $select_id); // id correspondente ao nome do pdi escolhido
										
										while($row = mysqli_fetch_array($query_id)){
											$id = $row['ID_PDI'];
											$insert_pdis="INSERT INTO rota_pdi (ID_Rota, ID_PDI) VALUES ('$ID_Rota', '$id')";
											mysqli_query($conn_bd, $insert_pdis);
										}
									}

									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Sucesso</font>
									</div>
									<div class="alert alert-success p-5" align="center">
										<font color="#444" size="6">Rota Turística adicionada com sucesso!</font>
										<?php
										header("refresh:1;url=gerir_rotas.php");
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
										<font color="#444" size="6">Erro ao adicionar Rota Turística</font>
										<?php
										header("refresh:2;url=gerir_rotas.php");
										?>
									</div>
									<?php
								}
							}
							else
							{
								?>
								<div class="card-header bg-dark" align="center">
									<font color="#fff" size="6">Erro</font>
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
