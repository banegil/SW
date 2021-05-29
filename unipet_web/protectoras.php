<?php

require_once __DIR__.'/includes/config.php';
require_once("includes\listaProtectoras.php");

$tituloPagina = 'Protectoras';
$protectoras = listaProtectoras();

$contenidoPrincipal = <<<EOS
<h1>Protectoras:</h1>
$protectoras
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';