<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);
//En este archivo hay que enviar el id del profe de alguna manera
$id_to_pass = $_POST['NumStu'];

header('Location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarProf.php?IDprof='.$id_to_pass);


?>