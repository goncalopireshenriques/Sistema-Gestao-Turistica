<link rel="stylesheet" type="text/css" href="css/styles.css">
<?php
session_start();
include("base_dados/basedados.h");?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Processa Resposta</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>

<div class="page-wrapper flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card text bg-dark">
					<div class="card-body">
						<?php
						if (isset($_SESSION['username']) && $_SESSION['perfil'] == '1' || $_SESSION['perfil'] == '0' )
						{

							$resposta = $_POST['resposta'];
							$id_comentario = $_POST['comentario'];
							$id_pdi = $_POST['pdi'];
							$categoria =  $_POST['categoria'];
							$tipo =  $_POST['tipo'];
							$id_operador = $_SESSION['id_operador'];

							$insertResposta = "UPDATE comentario SET Resposta='$resposta', Data_Resposta=NOW() WHERE ID_Comentario='$id_comentario'";

							if(mysqli_query($conn_bd, $insertResposta))
							{	
								$query = "INSERT INTO operadorturistico_comentario (ID_OperadorTuristico, ID_Comentario) VALUES ('$id_operador', '$id_comentario')";
								mysqli_query($conn_bd, $query);
								?>
								<div class="card-header bg-dark" align="center">
									<font color="#fff" size="6">Sucesso</font>
								</div>
								<?php  echo "$id_operador" ?>;
								<div class="alert alert-success p-5" align="center">
									<font color="#444" size="6">Resposta efetuada com sucesso</font>
									<?php
									if($tipo == 0)
									{ //comentario
										header("refresh:1;url=comentarios_associados.php?id_pdi=$id_pdi&categoria=$categoria");
									}
									else if($tipo == 1) 
									{ //comentario denuncia
										header("refresh:1;url=denuncias_associadas.php?id_pdi=$id_pdi&categoria=$categoria");
									}
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
									<font color="#444" size="6">Erro ao efetuar resposta!</font>
									<?php
									header("refresh:2;url=resposta.php?id_comentario=$id_comentario&categoria=$categoria&id_pdi=$id_pdi");
									?>
								</div>
								<?php
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
<script src="./vendor/jquery/jquery.min.js"></script>
<script src="./vendor/popper.js/popper.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="./vendor/chart.js/chart.min.js"></script>
<script src="./js/carbon.js"></script>
<script src="./js/demo.js"></script>
</html>
