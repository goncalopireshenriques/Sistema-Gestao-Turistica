<link rel="stylesheet" type="text/css" href="css/styles.css">
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
	<title>Sistema de Gestão Turística - Processa Editar Local Turístico</title>
	<link rel="stylesheet" href="./vendor/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="./vendor/font-awesome/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>

<div class="page-wrapper flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card bg-dark">
					<div class="card-body">

						<?php
						if (isset($_SESSION['username']) && $_SESSION['perfil'] == '1' || $_SESSION['perfil'] == '0')
						{
							$nome = $_POST['nome'];
							$descricao = $_POST['descricao'];
							$latitude = $_POST['latitude'];
							$longitude= $_POST['longitude'];
							$localizacao = $_POST['localizacao'];
							$tipo_pdi = $_POST['tipo_pdi'];
							$contacto = $_POST['contacto'];
							$website = $_POST['website'];
							$horario = $_POST['horario'];
							$precario = $_POST['precario'];
							$id_pdi = $_POST['id_pdi'];

							$tipo = "SELECT ID_TipoPDI FROM tipopdi WHERE Nome='$tipo_pdi'";
							$query_tipo = mysqli_query($conn_bd, $tipo); 							//id correspondente ao nome do tipopdi
							list($id_tipo) = mysqli_fetch_row($query_tipo);

							$updatePDI = "UPDATE pdi SET Nome = '$nome', Descricao = '$descricao', Latitude = '$latitude', Longitude = '$longitude', Localizacao = '$localizacao', ID_Tipo_PDI = '$id_tipo' WHERE ID_PDI = '$id_pdi'";

							if(mysqli_query($conn_bd, $updatePDI))
							{	

								$updateLocal = "UPDATE local SET Horario = '$horario', Contacto = '$contacto', Website = '$website', Precario = '$precario' WHERE ID_PDI = '$id_pdi'";
								mysqli_query($conn_bd, $updateLocal);

								if (!empty($_FILES["imagem"]["name"]) )
								{
									$legenda = $_POST['legenda'];
									
									$UploadedFileName=$_FILES['imagem']['name'];
									$upload_directory = "Inclusive_Images/"; 
									$targetPath= $UploadedFileName;

									$uploadfile_image = $upload_directory . basename($_FILES['imagem']['name']);
									copy($_FILES['imagem']['tmp_name'], $uploadfile_image);
									
									$select_img="SELECT * FROM imagem  WHERE ID_PDI = '$id_pdi'";
									$resultado = mysqli_query($conn_bd, $select_img);
									if (mysqli_num_rows($resultado) == 0) 
									{
										$insert_img = "INSERT INTO imagem (Imagem, Legenda, ID_PDI) VALUES ('$upload_directory$targetPath', '$legenda', $id_pdi)";
										mysqli_query($conn_bd, $insert_img);
									}
									else
									{
										$update_img = "UPDATE imagem SET Imagem = '$upload_directory$targetPath', Legenda = '$legenda' WHERE ID_PDI = '$id_pdi'";
										mysqli_query($conn_bd, $update_img);
									}
								}
								if (!empty($_FILES["qr_code"]["name"]))
								{
									$UploadedFileName_qrcode = $_FILES['qr_code']['name'];
									$upload_directory_qrcode = "Inclusive_QRCode/"; 
									$targetPath= $UploadedFileName_qrcode;

									$uploadfile_qr = $upload_directory_qrcode . basename($_FILES['qr_code']['name']);
									copy($_FILES['qr_code']['tmp_name'], $uploadfile_qr);

									$insert_qr_code = "UPDATE pdi SET QR_Code = '$upload_directory_qrcode$targetPath' WHERE ID_PDI = '$id_pdi'";
									mysqli_query($conn_bd, $insert_qr_code);

								}
								if (!empty($_FILES["audio"]["name"]))
								{
									$UploadedFileName_Audio =$_FILES['audio']['name'];
									$upload_directory_audio = "Inclusive_AD/"; 
									$targetPath_audio= $UploadedFileName_Audio;

									$uploadfile_audio = $upload_directory_audio . basename($_FILES['audio']['name']);
									copy($_FILES['audio']['tmp_name'], $uploadfile_audio);

									$insert_audio = "UPDATE pdi SET Audio = '$upload_directory_audio$targetPath_audio' WHERE ID_PDI = '$id_pdi'";
									mysqli_query($conn_bd, $insert_audio);
								}
								?>
								<div class="card-header bg-dark" align="center">
									<font color="#fff" size="6">Sucesso</font>
								</div>
								<div class="alert alert-success p-5" align="center">
									<font color="#444" size="6">Local editado com sucesso!</font>
									<?php
									header("refresh:1;url=gerir_locais.php");
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
									<font color="#444" size="6">Erro ao editar Local!</font>
									<?php
									header("refresh:2;url=editar_local.php?id_pdi=$id_pdi");
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
