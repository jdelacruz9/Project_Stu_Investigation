<?php
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);

$name = $_POST['EstName'];
$num = $_POST['EstNum'];
$email = $_POST['EstE'];
$tele  = $_POST['EstT'];
$year  = $_POST['EstA'];
$ccom = $_POST['EstCC'];

switch($ccom){
	case "Si":
    case "S" :
	case "si":
	case "s" :
			$clasif = 1;
			break;
    default : $clasif = 0;	
}
$estu_update = 'update Estudiantes set nombre="'.$name.'",email="'.$email.'",cell_num="'.$tele.'",year='.$year.',clasificado_ccom='.$clasif.' where est_id="'.$num.'";';
$estu_up_res = mysql_query($estu_update);
header('location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarEst.php?NumStu='.$num);

?>