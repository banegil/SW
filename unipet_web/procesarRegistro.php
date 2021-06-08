<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/usuarioDB.php';

Usuario::register($_POST['ID_usuario'], $_POST['DNI'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['email'], $_POST['contraseña'], $_POST['nacimiento'], $_POST['direccion'], getdate());
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
