<?php

require_once __DIR__.'/includes/config.php';
require_once ("includes/usuarioUtils.php");

$idAni = $_GET['id'];

$animal = es\ucm\fdi\aw\Animal::buscaPorID($idAni);
$nombre = $animal->getNombre();

$form = new es\ucm\fdi\aw\FormularioApadrina(idUsuarioLogado(), $idAni);
$htmlFormApadrina = $form->gestiona();

$tituloPagina = 'Apadrina';

$contenidoPrincipal = <<<EOS
   <h1>Apadrinando a {$nombre}. Gracias por su colaboracion :D</h1>
	$htmlFormApadrina
EOS;

require __DIR__.'/includes/plantillas/plantillaApadrina.php';
