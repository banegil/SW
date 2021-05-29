<?php

require_once __DIR__.'\includes\config.php';
require_once __DIR__.'\includes\FormularioRegistro.php';

$form = new FormularioRegistro("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Registro';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';