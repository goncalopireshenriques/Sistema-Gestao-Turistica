<?php
include_once("base_dados/basedados.h");
ob_start();
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Processa Login</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>
<body>
	<div class="page-wrapper flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card text bg-dark">
						<div class="card-body">
							<?php

							$username = $_POST['Username'];
							$password = $_POST['Password'];

							$query = "SELECT * FROM operadorturistico WHERE Username='$username'";

							$result = mysqli_query($conn_bd, $query);
							if(mysqli_num_rows($result) > 0) 
							{
								while($row = mysqli_fetch_array($result))
								{
									if(password_verify($password, $row['Password']))
									{
										$_SESSION['username'] = $row['Username'];
										$_SESSION['perfil'] = $row['PermissoesAdmin'];
										$_SESSION['id_operador'] = $row['ID_OperadorTuristico'];
 										header("location:index.php");
									}
									else
									{
										?>
										<div class="card-header bg-dark" align="center">
											<font color="#fff" size="6">Aviso</font>
										</div>
										<div class="alert alert-warning p-5" align="center">
											<font color="#444" size="6">Dados de Login incorretos!</font>
											<?php
											header("refresh:1;url=login.html");
											?>
										</div>
										<?php	
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
									<font color="#444" size="6">Dados de Login incorretos!</font>
									<?php
									header("refresh:1;url=login.html");
									?>
								</div>
								<?php
								ob_end_flush();
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
</body>
</html>
