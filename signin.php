<?php

	$host = "localhost";
	$usuario = "dramirez2";
	$password = "turntablepower2";
	$database = "estu_investigacion";

	$conexion = mysql_connect($host, $usuario, $password);
	mysql_select_DB($database);
	
	//$user = $_POST['usernames'];
	//$pass = $_POST['passwords'];
	
	session_start();
	
	$query_users = mysql_query('select username from Passwords where pass = "'.$_SESSION['pass'].'"');
	$query_pass = mysql_query('select pass from Passwords where username = "'.$_SESSION['user'].'"'); // using client input as variable for a query: asking to be hacked.																							 
	
	if (/*mysql_num_rows($query_pass) > 0 or*/ mysql_num_rows($query_users) > 0) // More than 1 row returned which means there is data
	{
		header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again
	
	}else{ // No rows were returned therefore there were no matches
	 
		header("location: http://ada.uprrp.edu/~ijimenez/Estu_Investigar/login.html"); //jump to PORTADA: investiga.php
	}
?>
	
	
	
	
	
	