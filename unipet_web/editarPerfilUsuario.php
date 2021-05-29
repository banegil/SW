<?php

require_once __DIR__.'\includes\config.php';
require_once __DIR__.'\includes\FormularioEditarUsuario.php';

$form = new FormularioEditarUsuario("1");
$htmlFormRegistro = $form->gestiona();

$tituloPagina = 'Actualizar';

$contenidoPrincipal = <<<EOS
<h1>Registro de usuario</h1>
$htmlFormRegistro
EOS;

require_once __DIR__.'/includes/plantillas/plantilla.php';