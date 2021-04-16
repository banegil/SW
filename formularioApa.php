<!DOCTYPE html>
<html>
	<head>
		<meta charset= "utf-8">
		<title>Formulario</title>
	</head>
	
	<body>

	<?php
		//require("cabecera.php");
	?>

	<main>
		<article>
			<h1>Formulario apadrinamiento:</h1>
			<form id="formApadrinamiento" action="./procesarApa.php" method="POST">
			<fieldset>
				<legend>Rellene las preguntas</legend>
				
				<div><label>¿Has tenido (o tienes) animales?</label> 
					<input type="radio" name="animalAnt" value="si" /> Si
					<input type="radio" name="animalAnt" value="no" checked/> No
				</div>
				
				<div><label>¿En que tipo de domicilio vives diariamente?</label> 
					<select name="typeOfHouse">
					  <option value="apartamento" selected>Apartamento</option>
					  <option value="pisoGrande">Apartamento grande</option>
					  <option value="chalet">Chalet</option>
					  <option value="finca">Finca</option>
					  <option value="ninguno">Ninguno</option>
					</select>
				</div>
				
				<div><label>¿Viven niños en el mismo domicilio en el que se encontrará el animal?</label> 
					<input type="radio" name="niños" value="si" /> Si
					<input type="radio" name="niños" value="no" checked/> No
				</div>
				
				<div><label>¿Cuantas horas estaría solo el animal?</label> 
					<input type="text" name="horaSolo" value="" size="50"/>
				</div>
				
				<div><label>¿Cual es tu motivación por adoptar un animal?</label> 
					<input type="text" name="razonAdopcion" value="" size="200"/>
				</div>
				
				<div><button type="submit">Enviar</button> <button type="reset">Restablecer formulario</button></div>
			</fieldset>
		</article>
	</main>
	
	<?php
		//require("pie.php");
	?>
	</div>

	</body>
</html>