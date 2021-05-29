<?php
require_once __DIR__.'\includes\config.php';
$tituloPagina="Añadir protectora";

$contenidoPrincipal= <<<EOS
		<h1>Nueva protectora: </h1>
			<form id="formAddProtectora" action="./procesarAddProtectora.php" method="POST">
			<fieldset>
				<legend>Rellene los datos de la protectora</legend>
				
				<div><label>Número de indentificación:</label> 
					<input type="number" name="idProtectora" value="" size="25"/>
				</div>	
				
				<div><label>Nombre:</label> 
					<input type="text" name="nameProtectora" value="" size="25"/>
				</div>
				
				<div><label>Dirección:</label> 
					<input type="text" name="direccion" value="" size="50"/>
				</div>
				
				<div><label>Teléfono:</label> 
					<input type="number" name="telefono" value="" size="15"/>
				</div>
				
				<div><button type="submit">Añadir</button> <button type="reset">Borrar todo</button></div>
			</fieldset>
EOS;
	require_once __DIR__.'/includes/plantillas/plantilla.php';
?>