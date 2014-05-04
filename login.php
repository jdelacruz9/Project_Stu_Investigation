<?php
	$host = "localhost";
	$usuario = "dramirez2";
	$password = "turntablepower2";
	$database = "estu_investigacion";

	$conexion = mysql_connect($host, $usuario, $password);
	mysql_select_DB($database);
	
	$user = $_POST['usernames'];
	$pass = $_POST['passwords'];
	
	$sql_users = 'select username from Passwords where pass = "'.$pass.'";';
	$query_users = mysql_query($sql_users);
	$sql_pass = 'select pass from Passwords where username = "'.$user.'";';
	$query_pass = mysql_query($sql_pass);
	if ($query_users == NULL && $query_ == NULL)
		header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html"); //ALERT!!! something typed is wrong; try again
	else 
		header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //jump to PORTADA: investiga.php

?>