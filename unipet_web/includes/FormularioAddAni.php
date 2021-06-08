<?php

namespace es\ucm\fdi\aw;

class FormularioAddAni extends Form
{
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
	    	$html = <<<EOS
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
			return $html;
    }
    

    protected function procesaFormulario($datos) {
		
		$result = array();
        $idAnimal = $datos['idAnimal'] ?? null;
		$nameAnimal = $datos['nameAnimal'] ?? null;
		$fechaNacimiento = $datos['fechaNacimiento'] ?? null;
		$type = $datos['type'] ?? null;
		$raza = $datos['raza'] ?? null;
		$sexo = $datos['sexo'] ?? null;
		$peso = $datos['peso'] ?? null;
		$fechaIngreso = $datos['fechaIngreso'] ?? null;
		$protectora = $datos['protectora'] ?? null;
		
		if (empty($idAnimal) || empty($nameAnimal) || empty($fechaNacimiento) || empty($type) || empty($raza) || empty($sexo) || empty($peso) || empty($fechaIngreso) || empty($protectora)){
			$result[] = 'No puede quedar un campo sin rellenar';
		}
		
		if (count($result) === 0) {
            $ani = Animal::buscaPorID($idAnimal);
            if ($ani) {
                $result[] = 'El id del animal ya está en uso, prueba con uno que no lo esté';
            } else {
				$ani = Animal::add($idAnimal, $nameAnimal, $fechaNacimiento, $type, $raza, $sexo, $peso, $fechaIngreso, $protectora);
				Animal::insertaAnimal($ani);
                $result = 'controlPanel.php';
            }
        }
		
		return $result;
	}
}
