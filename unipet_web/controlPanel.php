
<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaSolicitudes.php';

$solicitudes = listaSolicitudes(es\ucm\fdi\aw\Contrato:: getSolicitudes());

$tituloPagina = 'Panel de control';

$contenidoPrincipal = <<<EOS
	<h1>Solicitudes</h1>
	$solicitudes
	
	<h1>Protectoras</h1>
	<form action="protectoras.php">
		<input type="submit" value="Ver lista" />
	</form>

	<form action="addProtectora.php">
		<input type="submit" value="Añadir protectora" />
	</form>

	<h1>Animales</h1>
	</article>
	<form action="animalesAdopcion.php">
		<input type="submit" value="Ver Lista" />
	</form>

	</article>
	<form action="addAnimal.php">
		<input type="submit" value="Añadir animal" />
	</form>
	
	<h1>Usuarios</h1>
	</article>
	<form action="verlistausuarios.php">
		<input type="submit" value="Ver Lista" />
	</form>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
