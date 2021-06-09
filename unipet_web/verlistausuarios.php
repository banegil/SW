<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaUsuarios.php';

$usuarios = listaUsuarios(es\ucm\fdi\aw\Usuario:: getUsuarios());

$tituloPagina = 'Lista de usuarios';

$contenidoPrincipal = <<<EOS
	<h1 class="titulo">Usuarios</h1>
	$usuarios
	
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
