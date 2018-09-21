<?php
session_start();
include("../base_dados/basedados.h");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Processa registo</title>
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
								$nome = $_POST['nome'];
								$username = $_POST['username'];
								$password = $_POST['password'];
								$email = $_POST['email'];
								$contacto = $_POST['contacto'];

								$usernameRepetido =  "SELECT * FROM operadorturistico WHERE Username='$username'";
								$repetido = mysqli_query($conn_bd, $usernameRepetido);
								if(mysqli_num_rows($repetido) > 0)
								{
									?>
										<div class="card-header bg-dark" align="center">
											<font color="#fff" size="6">Aviso</font>
										</div>
										<div class="alert alert-warning p-5" align="center">
											<font color="#444" size="6">Username já existe, insira um novo username!</font>
											<?php
											header("refresh:2;url=registar_operador.php");
											?>
										</div>
										<?php
								}
								else
								{
									$password = password_hash($password, PASSWORD_DEFAULT); //gera hash da password, com a adicao de um "salt"
									$insertPDI = "INSERT INTO operadorturistico (Nome, Contacto, Password, Username, Email)
									VALUES ('$nome', '$contacto', '$password', '$username', '$email')";
									if(mysqli_query($conn_bd, $insertPDI))
									{
										?>
										<div class="card-header bg-dark" align="center">
											<font color="#fff" size="6">Sucesso</font>
										</div>
										<div class="alert alert-success p-5" align="center">
											<font color="#444" size="6">Operador Turístico registado com sucesso!</font>
											<?php
											header("refresh:1;url=gerir_operadores.php");
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
											<font color="#444" size="6">Erro ao registar Operador Turístico!</font>
											<?php
											header("refresh:2;url=registar_operador.php");
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
									<font color="#fff" size="6">Sucesso</font>
								</div>
								<div class="alert alert-warning p-5" align="center">
									<font color="#444" size="6">Efetue login!</font>
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