<?php
$hostname_bd = "localhost";
$database_bd = "";
$USER_BD = "";
$PASS_BD = "";

// Conexao ao servidor MySQL
if(!($conn_bd = mysqli_connect($hostname_bd, $USER_BD, $PASS_BD, $database_bd) or die('Impossível efetuar conexão')))
{
   echo "Erro ao conectar ao MySQL.";
   exit;
}

?>
