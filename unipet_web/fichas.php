<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaFichas.php';

$tituloPagina = 'Lista Fichas';
$fichas = es\ucm\fdi\aw\Ficha::getFichas();
$muestraFichas = listaFichas($fichas);



$contenidoPrincipal = <<<EOS
$muestraFichas
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
