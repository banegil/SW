<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'EditarProtectora';
$protectora = es\ucm\fdi\aw\Protectora::buscaProtectoraPorId($id));

if()
$contenidoPrincipal = <<<EOS
<h1>Editar Datos: </h1>
<form id="formModificaProtectora" action="procesarAddProtectora.php" method="POST">
<fieldset>
	<legend>Rellene los datos de la protectora</legend>
	
	<div><label>ID:</label> 
		<input type="number" name="idProtectora" value="<?=$id?>" size="25"/>
	</div>
	<?php                
		$protectora = es\ucm\fdi\aw\Protectora::buscaProtectoraPorId($id));   
	?>

	
	<div><label>Número de indentificación:</label> 
		<input type="number" name="idProtectora" value="<?=$protectora->getId()?>" size="25"/>
	</div>	
	
	<div><label>Nombre:</label> 
		<input type="text" name="nameProtectora" value="<?=$protectora->getNombre()?>" size="25"/>
	</div>
	
	<div><label>Direccion:</label> 
		<input type="text" name="raza" value="<?=$protectora->getDireccion()?>" size="25"/>
	</div>
	
	<div><label>Teléfono:</label> 
		<input type="text" name="protectora" value="<?=$protectora->getTelefono()?>" size="25"/>
	</div>

	<div><button type="submit">Actualizar</button> <button type="reset">Borrar todo</button></div>
</fieldset>
</form>
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
