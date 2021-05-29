<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/AnimalDB.php';
	require_once __DIR__.'/includes/UsuarioDB.php';
	require_once __DIR__.'/includes/ContratoDB.php';
	require("cabecera.php");
	
	
	$dni = $_GET['dni'];
	$id = $_GET['id'];
	 
	$contract = Contrato::buscaPorDNIeID($dni, $id);
	$animal = Animal::buscaPorID($id);
	$usuario = Usuario::buscaPorDNI($dni);

	echo '<h3>Estado de la solicitud: '.$contract->getEstado().'</h3>';
	echo '<h3>Nombre del usuario: '.$usuario->getNombre().' '.$usuario->getApellido().'</h3>';
	echo '<h3>Nombre animal: <a href = "perfil_animal.php?id='.$id.'">'.$animal->getNombre().'</a></h3>';
	echo '<h3>Formulario enviado: '.$contract->getFormulario().'</h3>';
	echo '<h3>Fecha de la solicitud: '.$contract->getFecha().'</h3>';
	
	if($_SESSION['tipo'] == "voluntario" || $_SESSION['tipo'] == "administrador"){
		echo '<form id="modEstado" action="./procesarCambio.php" method="POST">';
			$_SESSION['idContrato'] = $id;
			$_SESSION['dniContrato'] = $dni;
			//echo '<input type="hidden" id="dni" name="dni" value='.$dni .'/>';
			//echo '<input type="hidden" id="id" name="id" value='.$id.'/>';
			echo '<div><label>Estado: </label>';
				echo '<select name="estado">';
				  echo '<option value="EnTramite" selected>En tramite</option>';
				  echo '<option value="FaltDatos">Faltan datos</option>';
				  echo '<option value="PendCita">Pendiente de cita</option>';
				  echo '<option value="EsperaRes">Esperar respuesta</option>';
				  echo '<option value="Rechazado">Rechazar</option>';
				  echo '<option value="Aprobado">Aprobar</option>';
				echo '</select>';
				echo '<button type="submit">Enviar</button>';
			echo '</div>';
		echo '</form>';
	}
	require("pie.php");
?>