<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Ficha';
$idAnimal = $_GET['id'];
$ficha = es\ucm\fdi\aw\Ficha::buscaFichaPorId($idAnimal);
$vacunas = $ficha->getVacunas();
$observaciones = $ficha->getObservaciones();


$contenidoPrincipal = <<<EOS
<h1 class="titulo">Vacunas</h1>
$vacunas
<h1 class="titulo"> Observaciones</h1>
$observaciones
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
