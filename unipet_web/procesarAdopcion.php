<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/ContratoDB.php';

	$respuesta1 = $_POST['animalAnt'];
	$respuesta2 = $_POST['typeOfHouse'];
	$respuesta3 = $_POST['niños'];
	$respuesta4 = $_POST['horaSolo'];
	$respuesta5 = $_POST['razonAdopcion'];

	$textoFormulario = sprintf("¿Has tenido (o tienes) animales? %s 
								¿En que tipo de domicilio vives diariamente? %s 
								¿Viven niños en el mismo domicilio en el que se encontrará el animal? %s 
								¿Cuantas horas estaría solo el animal? %s
								¿Cual es tu motivación por adoptar un animal? %s"
						  , $respuesta1
						  , $respuesta2
						  , $respuesta3
						  , $respuesta4
						  , $respuesta5);
	
	$contract = Contrato::buscaPorDNIeID($_SESSION["DNI"],$_SESSION["idAnimal"]);
	
	
	if (!$contract) {
		$contract = Contrato::crea($_SESSION["DNI"], $_SESSION["idAnimal"], $textoFormulario);
		$contract->guarda();
	} else {
		if($contract->ComprobarEnProceso()){
			$contract-> setFormulario($textoFormulario);
			$contract->guarda();
		}
    }
	header( 'Location: index.php' );
?>