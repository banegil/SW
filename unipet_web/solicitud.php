<?php 
	require_once __DIR__.'/includes/config.php';
	
	$dni = $_GET['dni'];
	$id = $_GET['id'];
	$tituloPagina = "Solicitud";
	$contract = es\ucm\fdi\aw\Contrato::buscaPorDNIeID($dni, $id);
	$animal = es\ucm\fdi\aw\Animal::buscaPorID($id);
	$usuario = es\ucm\fdi\aw\Usuario::buscaPorID_usuario($dni);

	$contenidoPrincipal = '<h3>Estado de la solicitud: '.$contract->getEstado().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre del usuario: '.$usuario->getNombre().' '.$usuario->getApellido().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre animal: <a href = "perfil_animal.php?id='.$id.'">'.$animal->getNombre().'</a></h3>';
	$contenidoPrincipal .= '<h3>Formulario enviado: '.$contract->getFormulario().'</h3>';
	$contenidoPrincipal .= '<h3>Fecha de la solicitud: '.$contract->getFecha().'</h3>';
	
	if($_SESSION['tipo'] == "voluntario" || $_SESSION['tipo'] == "administrador"){
		$contenidoPrincipal .= '<form id="modEstado" action="./procesarCambio.php" method="POST">';
			$_SESSION['idContrato'] = $id;
			$_SESSION['dniContrato'] = $dni;
			
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
