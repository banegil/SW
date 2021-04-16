<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Panel de control</title>
	</head>

	<body>

		<div id="contenedor">

			<?php
				include("includes/cabecera.php");
				?>
				<main>
				<article>
						<h1>Solicitudes</h1>
						<?php
							require_once __DIR__.'/includes/config.php';
							require_once __DIR__.'/includes/ContratoDB.php';
							printf($solicitud = Contrato:: buscaSolicitud());
						
						?>
						<form action="addAnimal.php">
							<input type="submit" value="Añadir animal" />
						</form>
					</article>
				</main>

			<?php
				require("includes/pie.php");
			?>

			

		</div>

	</body>
</html>