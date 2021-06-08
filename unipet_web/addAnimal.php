<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioAddAni("1");
$htmlFormAddAni = $form->gestiona();

$tituloPagina = 'Add ani';

$contenidoPrincipal = "<h1>Añadir animal</h1>";

$contenidoPrincipal .= <<<EOS
$htmlFormAddAni
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';
