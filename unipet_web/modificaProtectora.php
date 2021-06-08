<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioEditaProtectora("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'ActualizarProtect';

$contenidoPrincipal = <<<EOS
<h1>Actualizar protectora</h1>
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';
