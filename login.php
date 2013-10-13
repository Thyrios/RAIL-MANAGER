
<?php
if (isset ($_POST['login'])) {
session_start();
include ("connexion.php");

$ur = strip_tags($_POST['user']);
$ps = strip_tags($_POST['password']);

$mysqli = new mysqli("$host", "$user", "$pass", "$db");

	if (mysqli_connect_errno()) {
		printf("Falló la conexión: %s\n", mysqli_connect_error());
		exit();
	}
	
$stc = $mysqli -> stmt_init();

	if ($stc -> prepare("SELECT COUNT(id) FROM player WHERE name = ? AND password = ?")) {
		
		$stc -> bind_param('ss', $ur, $ps);
		$stc -> execute();
		$stc -> bind_result($res);
		$stc -> fetch();
		
		
		if ($res != 1) {
		
			echo ("<center>Usario o contraseña incorrecta.</center>");
				
			}
		if ($res == 1) {
			echo ("Usuario correcto.");
			$_SESSION['user'] = $ur;
			$_SESSION['pass'] = $ps;
			mysql_connect("$host", "$user", "$pass");
			mysql_select_db("$db");
			$ids = mysql_query("SELECT id FROM player WHERE name = '$ur' AND password = '$ps'");
			$idc = mysql_fetch_assoc($ids);
			$idd = $idc['id'];
			$_SESSION['id'] = $idd;
			header('location: index.php');
		
			exit();
		}
	}
	
	else {
		echo ("Un error ha ocurrido.");
	
	}
	
}
?>


<center><form action="login.php" method="post" class="login"><br><br><br><br><br><br>
    <div><label>Nombre de usuario: </label><input name="user" type="text" ></div><br>
    <div><label>Contraseña: </label><input name="password" type="password"></div><br>
    <div><input name="login" type="submit" value="Entrar"></div>
</form></center>
