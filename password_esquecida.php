<?php
include("base_dados/basedados.h");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Getão Turística - Página de Password Esquecida</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
	<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>
<body>

	<div class="modal-dialog text-center">
		<div class="title">
			<h1>Sistema de Gest&atildeo Tur&iacutestica</h1>
		</div>
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				<div class="title">
					<h2>Recupere aqui a sua password</h2>
				</div>
				<form class="col-12" method="POST" action="processa_password_esquecida.php">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Email" required name="Email" id="Email">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required name="Username" id="Username">
					</div>
					
					<button type="submit" name="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Submeter</button>
				</form>


				<div class"col-12 forgot">
					<a href="login.html">Voltar</a>
				</div>

			</div>
		</div>
	</div>
</body>
</html>




























