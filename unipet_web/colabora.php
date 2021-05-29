<?php

require_once __DIR__.'/includes/FormularioColabora.php';
require_once __DIR__.'/includes/config.php';

$form = new FormularioColabora("1");
$htmlFormColabora = $form->gestiona();

$tituloPagina = 'Colabora';

$contenidoPrincipal = <<<EOS
<h1>Colabora</h1>
$htmlFormColabora
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';