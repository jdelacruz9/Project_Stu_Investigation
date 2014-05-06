<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);

session_start();
if(strlen($_SESSION['pass']) > 20 or strlen($_SESSION['user']) > 20)
{
header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html");
}
else
{
$query_users = mysql_query('select username from Passwords where pass = "'.$_SESSION['pass'].'"');
$query_pass = mysql_query('select pass from Passwords where username = "'.$_SESSION['user'].'"'); // using client input as variable for a query: asking to be hacked.

if (/*mysql_num_rows($query_pass) > 0 or*/ mysql_num_rows($query_users) > 0) // More than 1 row returned which means there is data
{
header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again

}else{ // No rows were returned therefore there were no matches

header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html"); //jump to PORTADA: investiga.php
}
}

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

header('Location: investiga.php');
?>