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
	<title>Sistema de Gestão Turística - Processa Adicionar Tipo de Ponto de Interesse</title>
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
							if (isset($_SESSION['username']) && $_SESSION['perfil'] == '1')
							{
								$nome = $_POST['nome'];

								$insert_tipo="INSERT INTO tipopdi (Nome) VALUES ('$nome')";

								//$insert_pdis="INSERT INTO tipopdi (ID_TipoPDI, Nome) SELECT ID_TipoPDI FROM tipopdi INNER JOIN operadorturistico_tipopdi AS op ON tipopdi.ID_TipoPDI = op.ID_TipoPDI";
								if(mysqli_query($conn_bd, $insert_tipo))
								{
									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Sucesso</font>
									</div>
									<div class="alert alert-success p-5" align="center">
										<font color="#444" size="6">Tipo de Ponto de Interesse adicionado com sucesso!</font>
										<?php
										header("refresh:1;url=gerir_tipo_pdi.php");
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
										<font color="#444" size="6">Erro ao adicionar Tipo de Ponto de Interesse!</font>
										<?php
										header("refresh:2;url=gerir_tipo_pdi.php");
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
