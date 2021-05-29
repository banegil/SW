<?php

require_once __DIR__."\includes\config.php";
require_once __DIR__."\includes\FormularioBusquedaAnimales.php";
require_once 'includes\AnimalDB.php';
require_once 'includes\comun\animalesEnAdopcion.php';

$tituloPagina = 'Animales en Adopcion';
$formBuscaAnimales = new FormularioBusquedaAnimales('1');
$form = $formBuscaAnimales->gestiona();

$contenidoPrincipal = <<<EOS
<h1>Animales en adopción</h1>
$form
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';