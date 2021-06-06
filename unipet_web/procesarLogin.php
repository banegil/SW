<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';

checkLogin();
?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Proceso Login</title>		
	</head>
	<body>
		<div id="contenedor">
			<?php
				require("cabecera.php");
			?>
			<main id="contenido">
				<?php
				if (!isset($_SESSION["login"])) { //Usuario incorrecto
				echo "<h1>ERROR</h1>";
				echo "<p>El usuario o contraseña no son válidos. vuelve a intentarlo</p>";
				}
				else { //Usuario registrado
				echo "<h1>Login correcto!</h1>";
				}
				?>
			</main>
			<?php require("pie.php");?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>
