
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

$invid = $_POST['InvId'];
$invtitulo = $_POST['InvTi'];
$invdesc = $_POST['InvDes'];
$invprod = $_POST['InvProd'];
$invprof = $_POST['InvProf'];
$invyear = $_POST['InvYear'];
$numEst = $_POST['NumEstu'];
//$sem = $_POST['Csem'];
//$nota = $_POST['Cnota'];
if ($invid != null){
$sql_insert_inv = 'insert into Investigacion (titulo,descripcion) values ("'.$invtitulo.'","'.$invdesc.'");';
$sql_insert_investiga = 'insert into Investiga (e_id,productos,years) values ("'.$numEst.'","'.$invprod.'",'.$invyear.');';

$inv_res = mysql_query($sql_insert_inv);
$investiga_res = mysql_query($sql_insert_investiga);

}

header('Location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarEst.php?NumStu='.$numEst);


?>