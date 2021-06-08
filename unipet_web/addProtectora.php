<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioAddProt("1");
$htmlFormAddProt = $form->gestiona();

$tituloPagina = 'Add prot';

$contenidoPrincipal = "<h1>Añadir protectora</h1>";

$contenidoPrincipal .= <<<EOS
$htmlFormAddProt
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';
