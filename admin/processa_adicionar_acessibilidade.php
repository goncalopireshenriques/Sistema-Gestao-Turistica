<?php
session_start();
include_once("../base_dados/basedados.h");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sistema de Gestão Turística - Processa Adicionar Tipo de Acessibilidade</title>
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
								$descricao = $_POST['descricao'];
								$tipo = $_POST['tipo'];
								foreach ($tipo as $tipo) 
								{
									$select_id ="SELECT ID_Tipo_Acessibilidade FROM tipo_acessibilidade WHERE Nome='$tipo'";
									$query_id = mysqli_query($conn_bd, $select_id);

									while($row = mysqli_fetch_array($query_id)){
										$id = $row['ID_Tipo_Acessibilidade'];
										$insert="INSERT INTO acessibilidade (Nome, Descricao) VALUES ('$nome', '$descricao')";
										mysqli_query($conn_bd, $insert);

										$id_acessibilidade = mysqli_insert_id($conn_bd);
										$insert_relacao="INSERT INTO acessibilidade_tipo_acessibilidade (ID_Acessibilidade, ID_Tipo_Acessibilidade) VALUES ('$id_acessibilidade', '$id')";

										if(mysqli_query($conn_bd, $insert_relacao))
										{
											?>
											<div class="card-header bg-dark" align="center">
												<font color="#fff" size="6">Sucesso</font>
											</div>
											<div class="alert alert-success p-5" align="center">
												<font color="#444" size="6">Acessibilidade adicionada com sucesso!</font>
												<?php
												header("refresh:1;url=gerir_acessibilidade.php");
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
												<font color="#444" size="6">Erro ao adicionar Acessibilidade!</font>
												<?php
												header("refresh:2;url=gerir_acessibilidade.php");
												?>
											</div>
											<?php
										}
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
