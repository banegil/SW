<?php

namespace es\ucm\fdi\aw;

class FormularioAddProt extends Form
{
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
	    	$html = <<<EOS
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
			return $html;
    }
    

    protected function procesaFormulario($datos) {
		
		$result = array();
        $idProtectora = $datos['idProtectora'] ?? null;
		$nameProtectora = $datos['nameProtectora'] ?? null;
		$direccion = $datos['direccion'] ?? null;
		$telefono = $datos['telefono'] ?? null;
		
		if (empty($idProtectora) || empty($nameProtectora) || empty($direccion) || empty($telefono) ){
			$result[] = 'No puede quedar un campo sin rellenar';
		}
		
		if (mb_strlen($telefono) != 9){
			$result[] = 'El telefono debe tener 9 digitos';
		}
		
		if (count($result) === 0) {
            $prot = Protectora::buscaProtectoraPorId($idProtectora);
            if ($prot) {
                $result[] = 'El id de la protectora ya está en uso, prueba con uno que no lo esté';
            } else {
				$prot = Protectora::add($idProtectora, $nameProtectora, $direccion, $telefono);
				Protectora::insertaProtectora($prot);
                $result = 'controlPanel.php';
            }
        }
		
		return $result;
	}
}
