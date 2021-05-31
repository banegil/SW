<?php
require 'Form.php';
require_once 'AnimalDB.php';
require_once 'comun/listaAnimales.php';
class FormularioBusquedaAnimales extends Form
{
	private $enviado = false;

  protected function generaCamposFormulario ($datos, $errores = array())
  {
      $camposFormulario=<<<EOF
      <fieldset>
        <legend>Busca Animales en Adopción</legend>
			            <div>
			                <label>Buscar por nombre:</label> <input type="text" name="nombreAnimal" />
			            </div>
			            <div>
			                <label>Buscar por tipo: </label> 
								<input type="radio" name="tipoAnimal" value="Todos" checked /> Todos
								<input type="radio" name="tipoAnimal" value="perro" /> Perros
								<input type="radio" name="tipoAnimal" value="gato" /> Gatos
								<input type="radio" name="tipoAnimal" value="otro" /> Otros
			            </div>
			            <div ><button type="submit" name="buscar">BUSCAR</button></div>
      </fieldset>
EOF;
	if (!$this->enviado) $camposFormulario .= listaAnimales(Animal::buscaAnimales(null,"Todos"));
      return $camposFormulario;
  }

  /**
   * Procesa los datos del formulario.
   */
  protected function procesaFormulario($datos)
  {
    $nombreAnimal = isset($_POST['nombreAnimal']) ? $_POST['nombreAnimal'] : null;
	$tipoAnimal = isset($_POST['tipoAnimal']) ? $_POST['tipoAnimal'] : "Todos";
	
	$busqueda = Animal::buscaAnimales($nombreAnimal,$tipoAnimal);
	if ($busqueda != null) {
		$result['busqueda'] = listaAnimales($busqueda);
		$this->enviado = true;
	}
	else {
		$result[] = "No se ha encontrado ningún animal";
		$this->enviado = false;
	}
	

    return $result;
  } 
}
?>