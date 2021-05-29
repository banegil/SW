<?php

require_once __DIR__.'/includes/config.php';
require_once("includes\comun\animalesEnAdopcion.php");
require_once("includes\AnimalDB.php");

$tituloPagina = 'Historias';
$adoptados = listaAnimales(Animal::getAnimalesAdoptados());

$contenidoPrincipal = <<<EOS
<h1>Nuestros animales adoptados</h1>
$adoptados
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';