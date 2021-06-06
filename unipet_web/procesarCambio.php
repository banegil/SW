<?php
	require_once __DIR__.'/includes/config.php';

	$dni = $_SESSION['dniContrato'];
	$id = $_SESSION['idContrato'];
	$estado = $_POST['estado'];
	
	$contract = es\ucm\fdi\aw\Contrato::buscaPorDNIeID($dni,$id);
	
	 if($contract != NULL){
		$contract->setEstado($estado);
		$contract->guarda();
	 }
	
	header( 'Location: controlPanel.php' );
	unset($_SESSION['dniContrato']);
	unset($_SESSION['idContrato']);
	
?>
