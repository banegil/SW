<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaHilos.php';

$tituloPagina = 'Foro';
$hilos = listaHilos(es\ucm\fdi\aw\Hilo::getHilos());

$contenidoPrincipal = <<<EOS
$hilos
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
