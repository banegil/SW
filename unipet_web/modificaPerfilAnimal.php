<?php

require_once __DIR__.'\includes\config.php';

$form = new es\ucm\fdi\aw\FormularioEditarAnimal("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Actualizar Animal';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';
