<?php
session_start();
$_SESSION['user']=$_REQUEST['usernames'];
$_SESSION['pass']=$_REQUEST['passwords'];

header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/signin.php")

?>