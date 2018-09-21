<?php
include("base_dados/basedados.h");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Getão Turística - Página de Reposição de Password</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
	<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>
<body>
	<?php
	$code = $_GET['code'];
	$username = $_GET['username'];
	?>
	<div class="modal-dialog text-center">
		<div class="title">
			<h1>Sistema de Gest&atildeo Tur&iacutestica</h1>
		</div>
		<div class="col-sm-8 main-section">
			<div class="modal-content">
				<div class="title">
					<h2>Reposição de Password</h2>
				</div>
				<form class="col-12" method="POST" action="processa_update_password.php">
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Nova Password" required name="nova_password" id="nova_password">
					</div>
					
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Repetição da Nova Password" required name="nova_password_conf" id="nova_password_conf">
					</div>

					<input type="hidden" id="code" name="code" value = "<?php echo $code?>">
					<input type="hidden" id="username" name="username" value = "<?php echo $username?>">  
					
					<button type="submit" name="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Submeter</button>
				</form>

			</div> 
		</div>
	</div>
</body>
</html>




























