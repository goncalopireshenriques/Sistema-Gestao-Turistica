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
	<title>Sistema de Gestão Turística - Processa Editar Dados</title>
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
								$username = $_POST['username'];
								$nome = $_POST['nome'];
								$email = $_POST['email'];
								$contacto = $_POST['contacto'];
								$id = $_POST['id_operador'];

								$usernameRepetido =  "SELECT * FROM operadorturistico WHERE Username='$username' AND ID_OperadorTuristico != '$id'";
								$repetido = mysqli_query($conn_bd, $usernameRepetido); //verifica se o username já existe, excluindo o proprio username
								if(mysqli_num_rows($repetido) > 0)
								{
									?>
									<div class="card-header bg-dark" align="center">
										<font color="#fff" size="6">Aviso</font>
									</div>
									<div class="alert alert-warning p-5" align="center">
										<font color="#444" size="6">Username já existe, insira um novo username!</font>
										<?php
										header("refresh:2;url=gerir_operadores.php");
										?>
									</div>
									<?php
								}
								else
								{
									if(empty($_POST['password']))
									{	
										$update_perfil = "UPDATE operadorturistico SET Nome = '$nome', Contacto = '$contacto', Username = '$username', Email = '$email' WHERE ID_OperadorTuristico = '$id'";
									}
									else
									{
										$password = $_POST['password'];
										$password = password_hash($password, PASSWORD_DEFAULT); //gera hash da password, com a adicao de um "salt"
										$update_perfil = "UPDATE operadorturistico SET Nome = '$nome', Contacto = '$contacto', Password = '$password',Username = '$username', Email = '$email' WHERE ID_OperadorTuristico = '$id'";
									}
									if(mysqli_query($conn_bd, $update_perfil))
									{
										?>
										<div class="card-header bg-dark" align="center">
											<font color="#fff" size="6">Sucesso</font>
										</div>
										<div class="alert alert-success p-5" align="center">
											<font color="#444" size="6">Dados de Perfil do Operador Turístico editados com sucesso!</font>
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
											<font color="#444" size="6">Erro ao editar Dados de Perfil do Operador Turístico!</font>
											<?php
											header("refresh:2;url=gerir_operadores.php");
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