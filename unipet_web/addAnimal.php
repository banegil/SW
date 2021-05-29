
<?php
		require_once __DIR__.'\includes\config.php';

$tituloPagina = "Añadir Animal";
$contenidoPrincipal = <<<EOS
			<h1>Nueva mascota: </h1>
			<form id="formAddAnimal" action="./procesarAddAnimal.php" method="POST">
			<fieldset>
				<legend>Rellene los datos del animal</legend>
				
				<div><label>Número de indentificación:</label> 
					<input type="number" name="idAnimal" value="" size="25"/>
				</div>	
				
				<div><label>Nombre:</label> 
					<input type="text" name="nameAnimal" value="" size="25"/>
				</div>
				
				<div><label>Nacimiento:</label> 
					<input type="date" name="fechaNacimiento" value="" size="25"/>
				</div>
				
				<div><label>Tipo:</label> 
					<select name="type">
					  <option value="perro" selected>Perro</option>
					  <option value="gato">Gato</option>
					</select>
				</div>
				
				<div><label>Raza:</label> 
					<input type="text" name="raza" value="" size="25"/>
				</div>
				
				<div><label>Sexo:</label> 
					<select name="sexo">
					  <option value="macho" selected>Macho</option>
					  <option value="hembra">Hembra</option>
					</select>
				</div>
				
				<div><label>Peso:</label> 
					<input type="number" name="peso" value="0" size="20"/>
				</div>
				
				<div><label>Ingreso:</label> 
					<input type="date" name="fechaIngreso" value="" size="25"/>
				</div>
				
				<div><label>Protectora:</label> 
					<input type="text" name="protectora" value="" size="25"/>
				</div>
				
				<div><button type="submit">Añadir</button> <button type="reset">Borrar todo</button></div>
			</fieldset>
EOS;
require_once __DIR__.'/includes/plantillas/plantilla.php';


