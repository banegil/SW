<?php
/*$tituloPagina="Formulario";
$contenidoPrincipal=   <<<EOS
		<h1>Formulario Adopción:</h1>
			<form id="formAdopción" action="./procesarAdopcion.php" method="POST">
			
			</form>
EOS;
	require_once __DIR__.'/includes/plantillas/plantilla.php';*/
	
	namespace es\ucm\fdi\aw;
	
	class FormularioAdopcion extends Form {

		protected function generaCamposFormulario($datos, $errores = array())
	    {
	    	$html = <<<EOS
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
EOS;
	    	return $html;
	  	}

	  	protected function procesaFormulario($datos)
	    {
	    	$errores = array();
			
	    	$animalAnt = isset($_POST['animalAnt']) ? $_POST['animalAnt'] : null;

			$typeOfHouse = isset($_POST['typeOfHouse']) ? $_POST['typeOfHouse'] : null;
			
			$niños = isset($_POST['niños']) ? $_POST['niños'] : null;
			
			$horaSolo = isset($_POST['horaSolo']) ? $_POST['horaSolo'] : null;
			
			$razonAdopcion = isset($_POST['razonAdopcion']) ? $_POST['razonAdopcion'] : null;
			
			
			if ( empty($animalAnt) || empty($typeOfHouse) || empty($niños) || empty($horaSolo) || empty($razonAdopcion) ) {
				$errores[] = "Ningún campo puede quedar sin responder.";
			}
			else{
				
				$contract = Contrato::buscaPorDNIeID($_SESSION['id'],$_SESSION['idAnimal']);
				
				if (!$contract) {
					$contract = Contrato::crea($_SESSION['id'], $_SESSION['idAnimal'], $textoFormulario);
					$contract->guarda();
				} else {
					if($contract->ComprobarEnProceso()){
						$contract-> setFormulario($textoFormulario);
						$contract->guarda();
					}
				}
				
				$errores = 'index.php';
			}
				
	        return $errores;
	    }
	}
?>