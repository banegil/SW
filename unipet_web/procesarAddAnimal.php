<?php
	require_once __DIR__.'/includes/config.php';

	$respuesta0 = filter_input(INPUT_POST, 'idAnimal', FILTER_SANITIZE_NUMBER_INT);
	$respuesta1 = filter_input(INPUT_POST, 'nameAnimal', FILTER_SANITIZE_STRING);
	$respuesta2 = filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_STRING);	
	$respuesta3 = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);	
	$respuesta4 = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);	
	$respuesta5 = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);	
	$respuesta6 = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_NUMBER_FLOAT);
	$respuesta7 = filter_input(INPUT_POST, 'fechaIngreso', FILTER_SANITIZE_STRING);
	$respuesta8 = filter_input(INPUT_POST, 'protectora', FILTER_SANITIZE_NUMBER_INT);
	
	$animal = es\ucm\fdi\aw\Animal::add($respuesta0,$respuesta1, $respuesta2, $respuesta3, $respuesta4, $respuesta5, $respuesta6, $respuesta7, $respuesta8);
	$animal->guarda();
	//Animal::insertaAnimal($animal);
	
	header( 'Location: controlPanel.php' );
?>
