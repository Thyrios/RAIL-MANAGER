<?php

require ("motion.php");
require ("class.php");
session_start();
if (!$_SESSION['user'] && !$_SESSION['pass']){
	header ('location:logout.php');
	exit();
}

$id = $_SESSION['id'];

$sel =	mysql_query("SELECT * FROM player WHERE id = '$id'", conect::con());
$sen = mysql_fetch_array($sel);
$money = $sen['money'];
$user = $sen['name'];
$uni = $sen['unidades'];
$base = $sen['base'];
$date = date('d M Y', time());
$hora = date('H:i', time());
	
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>RAIL MANAGER</title>
	<script src="js/modernizr.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="style/style.css" />
</head>

<body>
	<center>
  <head>
    <ul class="superior">
      <p><?php echo $user?> | <?php echo $base?> | Capital: <?php echo $money?> &euro; | Unidades: <?php echo $uni?> | <?php echo $date?> | <?php echo $hora?></p>
    </ul>
  </head>
  </center>
  
  <center>
	<div class='menu'>
		<p><a href='index.php'>Inicio</a> | <a href='flota.php'>Flota</a> | <a href='station.php'>Estaciones</a> | <a href='services.php'>Programaci&oacute;n</a> | <a href='trenes.php'>Cat&aacute;logo</a> | 
		<a href='logout.php'>Salir</a>
	</div>
  </center>	
<hr>
<?php
if (isset ($_SESSION['news'])) {
	echo '<p class="news">'.$_SESSION['news'].'</p>';
	unset ($_SESSION['news']);
}
?>
