<?php  
	namespace es\ucm\fdi\aw;

	class FormularioLogin extends Form {

		protected function generaCamposFormulario($datos, $errores = array())
	    {
	    	$html = <<<EOS
				<fieldset>
				  <div class="form">
					<h2>Login</h2>
					<div class="input">
					  <div class="inputBox">
						<label>DNI del usuario</label>
						<input type="text" name="ID_usuario" placeholder="ejemplo@gmail.com">
					  </div>
					  <div class="inputBox">
						<label>Contraseña</label>
						<input type="password" name="contraseña" placeholder="******">
					  </div>
					  <div class="inputBox">
						<input type="submit" name="" value="Entrar">
					  </div>
					</div>
				  </div>
				</fieldset>
EOS;
	    	return $html;
	  	}

	  	protected function procesaFormulario($datos)
	    {
	    	$errores = array();
	    	$ID_usuario = isset($_POST['ID_usuario']) ? $_POST['ID_usuario'] : null;

			if ( empty($ID_usuario) ) {
				$errores[] = "El DNI de usuario no puede estar vacío";
			}

			$pass = isset($_POST['contraseña']) ? $_POST['contraseña'] : null;
			if ( empty($pass) ) {
				$errores[] = "La contraseña no puede estar vacía.";
			}

			if (count($errores) === 0) {
				$usuario = Usuario::login($ID_usuario,$pass);
				if($usuario){
					$_SESSION['login'] = true;
					$_SESSION['ID_usuario'] = $usuario->getID();
					$_SESSION['DNI'] = $usuario->getDNI();
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
