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
	<title>Sistema de Gestão Turística - Processa Editar Rota Turística</title>
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
								$id_rota = $_POST['id_rota'];
								$nome = $_POST['nome'];
								$duracao = $_POST['duracao'];
								$descricao = $_POST['descricao'];
								$ordem = $_POST['ordem'];

								$update_rota = "UPDATE rota SET Nome = '$nome', Descricao = '$descricao', Duracao = '$duracao', Ordem = '$ordem' WHERE ID_Rota = '$id_rota'";

								if(mysqli_query($conn_bd, $update_rota))
								{	
									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Sucesso</font>
									</div>
									<div class="alert alert-success p-5" align="center">
										<font color="#444" size="6">Rota Turística editada com sucesso!</font>
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
										<font color="#444" size="6">Erro ao editar Rota Turística</font>
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
