<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Hilo';

if(isset($_GET['hilo'])){
	$numero = $_GET['hilo'];

	$contenidoPrincipal = <<<EOS
	<h1>Aqui iria la discusion del hilo. En este caso el hilo: $numero</h1>
	EOS;
}
else{
	$contenidoPrincipal = <<<EOS
	<h1>No se está pasando el numero del hilo</h1>
	EOS;
}

require __DIR__.'/includes/plantillas/plantilla.php';