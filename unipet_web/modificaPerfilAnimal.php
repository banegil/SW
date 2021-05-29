<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Animal.php';
require_once __DIR__.'/includes/AnimalDB.php'; 
require_once __DIR__.'/includes/Usuario.php';

$tituloPagina = 'EditarAnimal';

if(idSession() ){
	$animal = Animal::buscaPorID(idSession());
	
	$contenidoPrincipal = <<<EOS
	<h1>Editar Datos: </h1>
	<form id="formModificaAnimal" action="includes/procesarModificaAnimal.php" method="POST">
	<fieldset>
		<legend>Rellene los datos del animal</legend>
	 
		<div><label>Número de indentificación:</label> 
			<input type="number" name="idAnimal" value="<?=$animal->getId()?>" size="25" required/>
		</div>	
		
		<div><label>Nombre:</label> 
			<input type="text" name="nameAnimal" value="<?=$animal->getNombre()?>" size="25" required/>
		</div>
		
		<div><label>Nacimiento:</label> 
			<input type="date" name="fechaNacimiento" value="<?=$animal->getNacimiento()?>" size="25" required/>
		</div>
		
		<div><label>Tipo:</label> 
			<select name="type">
			  <option value="perro" selected>Perro</option>
			  <option value="gato">Gato</option>
			</select>
		</div>
		
		<div><label>Raza:</label> 
			<input type="text" name="raza" value="<?=$animal->getRaza()?>" size="25" required/>
		</div>
		
		<div><label>Sexo:</label> 
			<select name="sexo">
			  <option value="macho" selected>Macho</option>
			  <option value="hembra">Hembra</option>
			</select>
		</div>
		
		<div><label>Peso:</label> 
			<input type="number" name="peso" value="<?=$animal->getPeso()?>" size="20" required/>
		</div>
		
		<div><label>Ingreso:</label> 
			<input type="date" name="fechaIngreso" value="<?=$animal->getFecha_ingreso()?>" size="25" required/>
		</div>
		
		<div><label>Protectora ID:</label> 
			<input type="text" name="protectora" value="<?=$animal->getProtectora()?>" size="25" required/>
		</div>

		<div><label>Historia Feliz:</label> 
			<input type="text" name="protectora" value="<?=$animal->getHistoria_feliz()?>" size="25"/>
		</div>
		<div><label>Urgente:</label> 
			<select name="Urgencia">
			  <option value="1" selected>Si</option>
			  <option default="0">No</option>
			</select>
		</div>
		
		<div><button type="submit">Actualizara</button> <button type="reset">Borrar todo</button></div>
	</fieldset>
	</form>
	EOS;
}
else{
	$contenidoPrincipal = <<<EOS
	<p> No hemos encontrado a la mascota</p>
	EOS;
}

require __DIR__.'/includes/plantillas/plantilla.php';