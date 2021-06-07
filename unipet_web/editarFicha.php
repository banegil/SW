<?php

require_once __DIR__.'\includes\config.php';

$form = new es\ucm\fdi\aw\FormularioFicha("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Editar Ficha';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';
