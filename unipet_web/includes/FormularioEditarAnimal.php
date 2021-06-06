<?php

namespace es\ucm\fdi\aw;


class FormularioEditarAnimal extends Form
{
    public function __construct() {
        parent::__construct('formEditAnimal');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        
        $animal = Animal::buscaPorID($_GET['id']);

        $id =  $animal->getId() ?? '';
		$nombre =  $animal->getNombre() ?? '';
		$nacimiento =  $animal->getNacimiento() ?? '';
		$tipo =  $animal->getTipo() ?? '';
		$raza =  $animal->getRaza() ?? '';
		$sexo =  $animal->getSexo() ?? '';
		$peso =  $animal->getPeso() ?? '';
        $protectora =$animal->getProtectora() ?? '';
        $historia = $animal->getHistoria_feliz() ?? '';
        $urgente =  $animal->getUrgente() ?? '';

      
        $html = <<<EOF
            <fieldset>
                    <label>id:</label> <input class="control" type="text" name="id" value="$id" readonly/>
                    <label>Nombre:</label> <input class="control" type="text" name="nombre" value="$nombre"required/>
                    <label>Nacimiento:</label> <input class="control" type="date" name="nacimiento" value="$nacimiento" required/>
                    <label>tipo:</label> <input class="control" type="text" name="tipo" value="$tipo"required/>
                    <label>raza:</label> <input class="control" type="text" name="raza" value="$raza" required/>
                    <label>sexo:</label> <input class="control" type="text" name="sexo" value="$sexo" required />
                    <label>peso:</label> <input class="control" type="number" name="peso" value="$peso" required/>
                    <label>protectora:</label> <input class="control" type="number" name="protectora" value='$protectora' required/>
                    <label>historia:</label> <input class="control" type="text" name="historia feliz" value="$historia"/>
                    <label>urgente:</label> <input class="control" type="number" name="urgente 1/0" value="$urgente" required/>
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
        $sexo = $datos['sexo'] ?? null;
        if ( empty($sexo) || mb_strlen($sexo) < 2 ) {
            $result['sexo'] = "El sexo tiene que tener una longitud de al menos 2 caracteres.";
        }
		$raza = $datos['raza'] ?? null;
		$peso = $datos['peso'] ?? null;
        $tipo = $datos['tipo'] ?? null;
        $historia = $datos['historia'] ?? null;

        if ( empty($sexo) || mb_strlen($sexo) < 2 ) {
            $result['sexo'] = "El sexo tiene que tener una longitud de al menos 2 caracteres.";
        }
		$protectora = $datos['protectora'] ?? null;
        $urgente = $datos['urgente'] ?? null;
		
		
		// La fecha de naciemiento ya viene filtrada por type="date"
		$nacimiento = $datos['nacimiento'] ?? null;
		
	
        if (count($result) === 0) {
            $animal = Animal::actualizar($id, $nombre, $nacimiento, $tipo, $raza, $sexo, $peso, $protectora, $historia, $urgente);
            if ( ! $animal ) {
                $result[] = "El animal ya existe";
            } else {
                $result = "perfil_animal.php?id=".$id;
            }
        }
        return $result;
    }
}
