<?php

namespace es\ucm\fdi\aw;


class FormularioEditaProtectora extends Form
{
    public function __construct() {
        parent::__construct('formEditProtectora');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $idProtectora = $_GET['id'];
        $protectora = Protectora::buscaProtectoraPorId($idProtectora);

        $id =  $protectora->getID() ?? '';
		$nombre =  $protectora->getNombre() ?? '';
		$direccion =  $protectora->getDireccion() ?? '';
		$telefono =  $protectora->getTelefono() ?? '';
		

      
        $html = <<<EOF
            <fieldset>
                    <label>id:</label> <input class="control" type="text" name="id" value="$id" readonly/>
                    <label>Nombre:</label> <input class="control" type="text" name="nombre" value="$nombre"required/>
                    <label>Dirección:</label> <input class="control" type="text" name="nacimiento" value="$direccion" required/>
                    <label>Telefono:</label> <input class="control" type="number" name="tipo" value="$telefono"required/>
                    
                <div class="grupo-control"><button type="submit" name="actualizar">Actualizar</button></div>
            </fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
	
        $id = $datos['id'] ?? null;
        
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 3 ) {
            $result['nombre'] = "El nombre tiene que tener una longitud de al menos 3 caracteres.";
        }
		
        $direccion = $datos['direccion'] ?? null;
        if ( empty($direccion) || mb_strlen($direccion) < 5 ) {
            $result['direccion'] = "La direccion tiene que tener una longitud de al menos 5 caracteres.";
        }

        $telefono = $datos['telefono'] ?? null;
        if ( empty($telefono) || mb_strlen($telefono) < 9 ) {
            $result['telefono'] = "El telefono tiene que tener una longitud de al menos 9 caracteres.";
        }
		
	
        if (count($result) === 0) {
            $protectora = Protectora::actualizar($id, $nombre, $direccion, $telefono);
            if ( ! $animal ) {
                $result[] = "La protectora ya existe";
            } else {
                $result = "protectora.php?id=".$id;
            }
        }
        return $result;
    }
}
