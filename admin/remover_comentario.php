<?php
session_start();
include("../base_dados/basedados.h");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Remover Comentário</title>
	<link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="../vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
	<div class="page-wrapper flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card bg-dark">
						<div class="card-body">
							<?php
							if(isset($_SESSION['username']) && $_SESSION['perfil'] == '1')
							{
								$id_comentario = $_GET['id'];
								$tipo = $_GET['tipo'];
								$id_pdi = $_SESSION['id_pdi'];
								$delete = "DELETE a FROM avaliacao a INNER JOIN comentario c ON c.ID_Avaliacao=a.ID_Avaliacao WHERE c.ID_Comentario='$id_comentario'"; 
								mysqli_query($conn_bd, $delete);
								if($tipo == 0) //apenas comentario
								{ 
									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Sucesso</font>
									</div>
									<div class="alert alert-success p-5" align="center">
										<font color="#444" size="6">Comentário removido com sucesso!</font>

										<?php
										header("refresh:1;url=../comentarios_associados.php?id_pdi=$id_pdi");
										?>

									</div>
									<?php
								}
								if($tipo == 1) //comentario que e uma denuncia
								{
									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Sucesso</font>
									</div>
									<div class="alert alert-success p-5" align="center">
										<font color="#444" size="6">Denúncia removida com sucesso!</font>

										<?php
										header("refresh:1;url=../denuncias_associadas.php?id_pdi=$id_pdi");
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
								<div class="alert alert-danger p-5" align="center">
									<font color="#444" size="6">Efetue Login!</font>

									<?php
									header("refresh:2;url=../login.html");
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