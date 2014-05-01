<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);


$estuName = $_POST['ModNStu'];
$estuID = $_POST['ModIDStu'];
$estuE = $_POST['ModEStu'];
$estuT = $_POST['ModTStu'];
$estuA = $_POST['ModAStu'];
$estuCC = $_POST['ModCCStu'];

switch($estuCC){
	case "Si":
    case "S" :
	case "si":
	case "s" :
			$clasif = 1;
			break;
    default : $clasif = 0;	
}

$ProfN = $_POST['ModNProf'];
$ProfE = $_POST['ModEProf'];

$insert_stu = 'insert into Estudiantes (est_id, nombre, email,cell_num,year,clasificado_ccom) value ("'.$estuID.'","'.$estuName.'","'.$estuE.'","'.$estuT.'",'.$estuA.','.$clasif.');';
$insert_prof = 'insert into Profesor (nombre, email) value ("'.$ProfN.'","'.$ProfE.'");';
$sql_insert_stu = mysql_query($insert_stu);
$sql_insert_prof = mysql_query($insert_prof);
echo $insert_stu;
header('Location: investiga.php');
?>