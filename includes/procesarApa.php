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
	
	
	$_SESSION["idUsuario"] = "00000000A";
	$_SESSION["idAnimal"] = "15";
	$contract = Contrato::buscaPorDNIeID($_SESSION["idUsuario"],$_SESSION["idAnimal"]);
	
	
	if (!$contract) {
		$contract = Contrato::crea($_SESSION["idUsuario"], $_SESSION["idAnimal"], $textoFormulario);
		$contract->guarda();
		echo '<h2>Formulario enviado!</h2>';
	} else {
		if($contract->ComprobarEnProceso()){
			$contract-> setFormulario($textoFormulario);
			$contract->guarda();
			echo '<h2>Formulario reenviado! (datos actualizados)</h2>';
		}
		else
			echo '<h2>Su formulario ya está siendo revisado...</h2>';
    }
	
	echo '<p>Serás redirigido a la pagina principal en 5 segundos</p>';
	header( "refresh:5; url=./paginaPrincipal.php" );
?>