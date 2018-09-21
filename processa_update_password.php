<?php
include("base_dados/basedados.h");

if(isset($_POST['submit']))
{
	$nova_password = $_POST['nova_password'];
	$nova_password_conf = $_POST['nova_password_conf'];
	$code = $_POST['code'];
	$username = $_POST['username'];
		
		if($nova_password == $nova_password_conf)
		{
			//$nova_password = password_hash($password_nova, PASSWORD_DEFAULT);
			$update_password = "UPDATE operadorturistico SET Password='$nova_password', PasswordReset = '0' WHERE PasswordReset='$code' AND Username = '$username'";
			$query_update = mysqli_query($conn_bd, $update_password);

			echo "Password alterada com sucesso, efetue login!";
			echo "$code";
			header("refresh:5;url=login.html");

		}
		else
		{
			echo "Passwords não são compativeis";
			header("refresh:1;url=repor_password.php?code=$code");
		}
}
?>


























