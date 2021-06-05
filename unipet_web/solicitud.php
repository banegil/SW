<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/AnimalDB.php';
	require_once __DIR__.'/includes/UsuarioDB.php';
	require_once __DIR__.'/includes/ContratoDB.php';
	require_once ("includes/Usuario.php");
	
	
	$id_usuario = $_GET['dni'];
	$id = $_GET['id'];
	 
	$contract = Contrato::buscaPorDNIeID($id_usuario, $id);
	$animal = Animal::buscaPorID($id);
	$usuario = Usuario::buscaPorID($id_usuario);

	$contenidoPrincipal = '<h3>Estado de la solicitud: '.$contract->getEstado().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre del usuario: '.$usuario->getNombre().' '.$usuario->getApellido().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre animal: <a href = "perfil_animal.php?id='.$id.'">'.$animal->getNombre().'</a></h3>';
	$contenidoPrincipal .= '<h3>Formulario enviado: '.$contract->getFormulario().'</h3>';
	$contenidoPrincipal .= '<h3>Fecha de la solicitud: '.$contract->getFecha().'</h3>';
	
	if(permisosVoluntario()){
		$contenidoPrincipal .= '<form id="modEstado" action="./procesarCambio.php" method="POST">';
			$_SESSION['idContrato'] = $id;
			$_SESSION['dniContrato'] = $id_usuario;
			//echo '<input type="hidden" id="dni" name="dni" value='.$dni .'/>';
			//echo '<input type="hidden" id="id" name="id" value='.$id.'/>';
			$contenidoPrincipal .= <<<EOS
					<div><label>Estado: </label>
					<select name="estado">
				  <option value="EnTramite" selected>En tramite</option>
				  <option value="FaltDatos">Faltan datos</option>
				  <option value="PendCita">Pendiente de cita</option>
				  <option value="EsperaRes">Esperar respuesta</option>
				  <option value="Rechazado">Rechazar</option>
				  <option value="Aprobado">Aprobar</option>
				</select>
				<button type="submit">Enviar</button>
			</div>
		</form>
EOS;
	}
	require __DIR__.'/includes/plantillas/plantilla.php';
?>