
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

$codigo = $_POST['CCodi'];
$titulo = $_POST['Ctitu'];
$desc = $_POST['Cdesc'];
$sem = $_POST['Csem'];
$nota = $_POST['Cnota'];
$numEst = $_POST['EstNum'];
if ($codigo != null){
$sql_insert_curso = 'insert into Curso_CCOM (titulo,descripcion,codigo) values ("'.$titulo.'","'.$desc.'","'.$codigo.'");';
$sql_insert_toma = 'insert into Toma_Curso (nota,semestre,codigo_curso,num_est) values ("'.$nota.'","'.$sem.'","'.$codigo.'","'.$numEst.'");';

$curso_res = mysql_query($sql_insert_curso);
$toma_res = mysql_query($sql_insert_toma);

}

header('Location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarEst.php?NumStu='.$numEst);


?>