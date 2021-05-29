<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/AnimalDB.php';

	$respuesta0 = filter_input(INPUT_POST, 'idAnimal', FILTER_SANITIZE_NUMBER_INT);
	$respuesta1 = filter_input(INPUT_POST, 'nameAnimal', FILTER_SANITIZE_STRING);
	$respuesta2 = filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_STRING);	
	$respuesta3 = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);	
	$respuesta4 = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);	
	$respuesta5 = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);	
	$respuesta6 = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_NUMBER_FLOAT);
	$respuesta7 = filter_input(INPUT_POST, 'fechaIngreso', FILTER_SANITIZE_STRING);
	$respuesta8 = filter_input(INPUT_POST, 'protectora', FILTER_SANITIZE_NUMBER_INT);
	

	
	$animal = Animal::add($respuesta0,$respuesta1, $respuesta2, $respuesta3, $respuesta4, $respuesta5, $respuesta6, $respuesta7, $respuesta8);
	$animal->guarda();
	//Animal::insertaAnimal($animal);
	
	if (!Animal::buscaPorID($respuesta0)) {
      echo '<h2>Error al enviar formulario...</h2>';
    } else {
      echo '<h2>Formulario enviado!</h2>';
    }
	
	echo '<p>Serás redirigido al panel de control en 5 segundos</p>';
	header( 'Location: index.php' );
?>