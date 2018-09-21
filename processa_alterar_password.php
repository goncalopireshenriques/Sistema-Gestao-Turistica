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
	<title>Sistema de Gestão Turística - Processa Alterar Password</title>
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
							if(isset($_SESSION['username']) && $_SESSION['perfil'] == '1' ||  $_SESSION['perfil'] == '0')
							{	
								$username = $_SESSION['username'];
								$password_nova = $_POST['password_nova'];
								$password_conf = $_POST['password_conf'];
								$password = $_POST['password_atual'];

								$select_password = "SELECT Password FROM operadorturistico WHERE Username='$username'";
								$query_password = mysqli_query($conn_bd, $select_password);
								$row = mysqli_fetch_array($query_password);

								if($password_nova == $password_conf)
								{
									if(password_verify($password, $row["Password"]))
									{
										$password_nova = password_hash($password_nova, PASSWORD_DEFAULT);
										$update_perfil = "UPDATE operadorturistico SET  Password = '$password_nova' WHERE username = '$username'";	
										if(mysqli_query($conn_bd, $update_perfil))
										{
											?>
											<div class="card-header bg-dark" align="center">
												<font color="#fff" size="6">Sucesso</font>
											</div>
											<div class="alert alert-success p-5" align="center">
												<font color="#444" size="6">Password alterada com sucesso!</font>
												<?php
												header("refresh:1;url=gerir_perfil.php");
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
												<font color="#444" size="6">Erro ao alterar password!</font>
												<?php
												header("refresh:2;url=gerir_perfil.php");
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
											<font color="#444" size="6">Password Atual Incorreta!</font>
											<?php
											header("refresh:2;url=alterar_password.php");
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
										<font color="#444" size="6">A nova password e a password de confirmação devem ser iguais!</font>
										<?php
										header("refresh:2;url=alterar_password.php");
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
									<font color="#444" size="6">Efetue login!</font>
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