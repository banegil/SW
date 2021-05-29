<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/AnimalDB.php';



	
	$respuesta0 = filter_input(INPUT_POST, 'idAnimal', FILTER_SANITIZE_NUMBER_INT);
	$respuesta1 = filter_input(INPUT_POST, 'nameAnimal', FILTER_SANITIZE_STRING);
	$respuesta2 = filter_input(INPUT_POST, 'fechaNacimiento');	
	$respuesta3 = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);	
	$respuesta4 = filter_input(INPUT_POST, 'raza', FILTER_SANITIZE_STRING);	
	$respuesta5 = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);	
	$respuesta6 = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_NUMBER_FLOAT);
	$respuesta7 = filter_input(INPUT_POST, 'fechaIngreso');
	$respuesta8 = filter_input(INPUT_POST, 'protectora', FILTER_SANITIZE_NUMBER_INT);
	$respuesta9 = filter_input(INPUT_POST, 'historia_feliz', FILTER_SANITIZE_STRING);
	$respuesta10 = filter_input(INPUT_POST, 'urgente', FILTER_SANITIZE_NUMBER_INT); // si es 1 es urgente si es 0 no urgente

	
	
	$animal = Animal::actualizar($respuesta0,$respuesta1, $respuesta2, $respuesta3, $respuesta4, $respuesta5, $respuesta6, $respuesta7, $respuesta8, $respuesta9,$respuesta10);
	$animal->actualiza();

	//Animal::insertaAnimal($animal);
	
	if (!Animal::buscaPorID($respuesta0)) {
      echo '<h2>Error al enviar formulario...</h2>';
    } else {
      echo '<h2>El animal se ha actualizado con Ã©xito!</h2>';
    }

	header("Location: /unipet_web/perfil_animal.php?id=".$animal->getId());
	
?>