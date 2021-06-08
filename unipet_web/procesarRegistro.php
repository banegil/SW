<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarioDB.php';



?>

<!DOCTYPE html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Proceso Registro</title>		
	</head>
	<body>
		<div id="contenedor">
			<?php
			require("cabecera.php");
			?>
			<main id="contenido">
				<?php
				if (!($_SESSION["register"])) { //Usuario incorrecto
				echo "<h1>ERROR</h1>";
				echo "<p>El usuario no es válido. vuelve a intentarlo</p>";				
				}
				else { //Usuario registrado
				echo "<h1>¡Registro completado!</h1>";				
				}
				unset($_SESSION["register"]);
				?>
			</main>
			<?php require("pie.php");?>
		</div> <!-- Fin del contenedor -->
	</body>
</html>
