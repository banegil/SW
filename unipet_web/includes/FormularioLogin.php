<?php
  
	namespace es\ucm\fdi\aw;
	
	class FormularioLogin extends Form {

		protected function generaCamposFormulario($datos, $errores = array())
	    {
	    	$html = <<<EOS
					<fieldset>
			            <legend>Usuario y contraseña</legend>
			            <div>
			                <label>DNI:</label> <input type="text" name="DNI" />
			            </div>
			            <div>
			                <label>Contraseña:</label> <input type="password" name="contraseña" />
			            </div>
			            <div><button type="submit" name="login">Entrar</button></div>
					</fieldset>
EOS;
	    	return $html;
	  	}

	  	protected function procesaFormulario($datos)
	    {
	    	$errores = array();
	    	$DNI = isset($_POST['DNI']) ? $_POST['DNI'] : null;

			if ( empty($DNI) ) {
				$errores[] = "El DNI no puede estar vacío";
			}

			$pass = isset($_POST['contraseña']) ? $_POST['contraseña'] : null;
			if ( empty($pass) ) {
				$errores[] = "La contraseña no puede estar vacía.";
			}

			if (count($errores) === 0) {
				$usuario = Usuario::login($DNI,$pass);
				if($usuario){
					$_SESSION['login'] = true;
					//$_SESSION['DNI'] = $DNI;
					$_SESSION['tipo'] = $usuario->getTipo();
					$_SESSION['nombre'] = $usuario->getNombre();
					$_SESSION['id'] = $usuario->getID();
					$errores = 'index.php';
				}
				else{ 
					$errores[]="Usuario o contraseña no validos";
				}
				
			}
				
	        return $errores;
	    }
	}
?>
