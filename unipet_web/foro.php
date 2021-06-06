<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaHilos.php';

$tituloPagina = 'Foro';
$hilos = listaHilosPaginado(es\ucm\fdi\aw\Hilo::getHilos(),5,1);

$contenidoPrincipal = <<<EOS
$hilos
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
