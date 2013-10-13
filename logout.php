<?php
    session_start();
	
if (!$_SESSION['user'] && !$_SESSION['pass']){
	header ('location:login.php');
	exit();
}
    session_destroy();
    header('location:login.php');
?>
