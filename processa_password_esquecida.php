<?php
include("base_dados/basedados.h");

if(isset($_POST['submit']))
{
	$email = $_POST['Email'];
	$username = $_POST['Username'];

	//$select_operador = "SELECT * FROM operadorturistico WHERE Username='$username'";
	$query = mysqli_query($conn_bd, $select_operador);
	$numrow = mysqli_num_rows($query);

	if($numrow>0)
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$bd_email = $row['Email'];
		}
		if($email == $bd_email)
		{

			$code = rand(10000,1000000);

			$destinatario = $bd_email;
			$from = "sistemagestaoturistica@gmail.com";
			$headers = "From: $from"; 
			$assunto = "Repor Password";
			$corpo = "Olá $username, 

			Está a receber esta mensagem de correio eletrónico porque pediu a reposição da password para a sua conta no Sistema de Gestão Turística. Se não pediu esta alteração, pode ignorar esta mensagem. Para escolher uma nova palavra-passe e concluír o teu pedido, siga a ligação em baixo: http://projectos.est.ipcb.pt/inclusive/Sistema_Gestao_Turistica/repor_password.php?code=$code&username=$username";

			$update_operador = "UPDATE operadorturistico SET PasswordReset='$code' WHERE Username='$username'";
			$query_update = mysqli_query($conn_bd, $update_operador);

			mail($destinatario, $assunto, $corpo, $headers, "-f " . $from);

			echo "verifique o seu email";
			header("refresh:1;url=login.html");

		}
		else
		{
			echo "Email esta incorreto";
			header("refresh:1;url=password_esquecida.php");
		}
	}
	else
	{
		echo "Username não existe";
		header("refresh:1;url=password_esquecida.php");
	}
}
?>