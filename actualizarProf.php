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
//header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again

}else{ // No rows were returned therefore there were no matches

header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html"); //jump to PORTADA: investiga.php
}
}

$button = $_POST['deleteProf'];
$id2 = $_POST['ProfeID'];
if ($button == "DELETE"){
mysql_query('delete from Profesor where prof_id='.$id2.';');
header('location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php');
exit;
}
$nombre = $_POST['ProfNom'];
$email = $_POST['ProfEma'];
$id= $_POST['idProfe'];

if ($nombre !=null){
mysql_query('update Profesor set nombre = "'.$nombre.'" where prof_id ='.$id.';');
}
if ($email !=null){
mysql_query('update Profesor set email = "'.$email.'" where prof_id ='.$id.';');
}
header('location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarProfe.php?IDprof='.$id);

?>