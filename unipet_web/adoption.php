<?php
require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioAdopcion("1");
$htmlFormAdopt = $form->gestiona();

$tituloPagina = 'Adoption';

$contenidoPrincipal = <<<EOS
<h1>Inicio proceso adopcion</h1>
$htmlFormAdopt
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';