<?php

require_once __DIR__.'/includes/config.php';
require_once ("includes/listaProtectoras.php");

$tituloPagina = 'Protectoras';
$protectors = listaProtectoras();

$contenidoPrincipal = <<<EOS
<h1>Protectoras:</h1>
$protectors
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';