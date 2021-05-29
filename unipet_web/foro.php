<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Foro';

$contenidoPrincipal = <<<EOS
<h1>Aqui irian todos los hilos de la aplicacion</h1>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';