<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);

$id_to_pass = $_POST['NumStu'];

header('Location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarEst.php?NumStu='.$id_to_pass);


?>