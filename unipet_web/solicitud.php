<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/usuarioUtils.php';
	
	$idAni = $_GET['idAni'];
	$idUsu = $_GET['idUsu'];
	
	$tituloPagina = "Solicitud";
	
	$contract = es\ucm\fdi\aw\Contrato::buscaPorIDeID($idUsu, $idAni);
	$animal = es\ucm\fdi\aw\Animal::buscaPorID($idAni);
	$usuario = es\ucm\fdi\aw\Usuario::buscaPorID_usuario($idUsu);

	$contenidoPrincipal = '<h3>Estado de la solicitud: '.$contract->getEstado().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre del usuario: '.$usuario->getNombre().' '.$usuario->getApellido().'</h3>';
	$contenidoPrincipal .= '<h3>Nombre animal: <a href = "perfil_animal.php?id='.$idAni.'">'.$animal->getNombre().'</a></h3>';
	$contenidoPrincipal .= '<h3>Formulario enviado: '.$contract->getFormulario().'</h3>';
	$contenidoPrincipal .= '<h3>Fecha de la solicitud: '.$contract->getFecha().'</h3>';
	
	if(permisosVoluntario()){
		
		$form = new es\ucm\fdi\aw\FormularioCambio($idAni, $idUsu);
		$htmlFormCambio = $form->gestiona();
		
		$contenidoPrincipal .=<<<EOS
		$htmlFormCambio
EOS;

	}
	require __DIR__.'/includes/plantillas/plantilla.php';
?>
