<?php
	require_once __DIR__.'/includes/config.php';

	$respuesta0 = filter_input(INPUT_POST, 'idProtectora', FILTER_SANITIZE_NUMBER_INT);
	$respuesta1 = filter_input(INPUT_POST, 'nameProtectora', FILTER_SANITIZE_STRING);
	$respuesta2 = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);	
	$respuesta3 = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);	
	
	$protectora = es\ucm\fdi\aw\Protectora::add($respuesta0,$respuesta1, $respuesta2, $respuesta3);
	$protectora->guarda();
	
	header( 'Location: controlPanel.php' );
?>
