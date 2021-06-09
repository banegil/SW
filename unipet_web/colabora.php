<?php

require_once __DIR__.'/includes/config.php';
require_once ("includes/usuarioUtils.php");

$tituloPagina = 'Colabora';

if(!estaLogado()){
	$contenidoPrincipal = <<<EOS
	<h1>Para colaborar con nosotros necesitamos que se registre primero <a href = "register.php">aquí</a>. o si ya tiene cuenta loguearse <a href = "login.php">aquí</a>.</h1>
EOS;
}
else{
	
	$form = new es\ucm\fdi\aw\FormularioColabora("1");
	$htmlFormColabora = $form->gestiona();
	
	$contenidoPrincipal = <<<EOS
	<h1>Voluntariado</h1>
	$htmlFormColabora
EOS;
}

require __DIR__.'/includes/plantillas/plantilla.php';
