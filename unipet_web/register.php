<?php

require_once __DIR__.'\includes\config.php';
require_once __DIR__.'\includes\FormularioRegistro.php';

$form = new FormularioRegistro("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantillaRegistro.php';
