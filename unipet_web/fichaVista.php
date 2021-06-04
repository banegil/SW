<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__. '/includes/FichaClase.php';


$tituloPagina = 'Ficha';
$idAnimal = $_GET['id'];
$ficha = Ficha::buscaFichaPorId($idAnimal);
$vacunas = $ficha->getVacunas();
$observaciones = $ficha->getObservaciones();


$contenidoPrincipal = <<<EOS
<h1 class="titulo">Vacunas</h1>
$vacunas
<h1 class="titulo"> Observaciones</h1>
$observaciones
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
