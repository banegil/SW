<?php
	require_once __DIR__.'/includes/config.php';

	$respuesta0 = filter_input(INPUT_POST, 'idProtectora', FILTER_SANITIZE_NUMBER_INT);
	$respuesta1 = filter_input(INPUT_POST, 'nameProtectora', FILTER_SANITIZE_STRING);
	$respuesta2 = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_STRING);	
	$respuesta3 = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);	
	
	$protectora = es\ucm\fdi\aw\Protectora::add($respuesta0,$respuesta1, $respuesta2, $respuesta3);
	$protectora->guarda();
	
	if (!es\ucm\fdi\aw\Protectora::buscaProtectoraPorId($respuesta0)) {
      echo '<h2>Error al enviar formulario...</h2>';
    } else {
      echo '<h2>Se ha añadido la protectora correctamente</h2>';
    }
	
	echo '<p>Serás redirigido al panel de control en 5 segundos</p>';
	header( "refresh:5; url=./controlPanel.php" );
?>
