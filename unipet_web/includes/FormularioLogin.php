<?php  
	require 'UsuarioDB.php';
	require 'Form.php';
	class FormularioLogin extends Form {

		protected function generaCamposFormulario($datos, $errores = array())
	    {
	    	$html = <<<EOS
					<fieldset>
						<head>
						  <meta charset="UTF-8" />
						  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
						  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
						</head>

						<body>
						  <div class="form">
							<h2>Login</h2>
							<div class="input">
							  <div class="inputBox">
								<label>Nombre de usuario</label>
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
						</body>
					</fieldset>
EOS;
	    	return $html;
	  	}

	  	protected function procesaFormulario($datos)
	    {
	    	$errores = array();
	    	$ID_usuario = isset($_POST['ID_usuario']) ? $_POST['ID_usuario'] : null;

			if ( empty($ID_usuario) ) {
				$errores[] = "El nombre de usuario no puede estar vacío";
			}

			$pass = isset($_POST['contraseña']) ? $_POST['contraseña'] : null;
			if ( empty($pass) ) {
				$errores[] = "La contraseña no puede estar vacía.";
			}

			if (count($errores) === 0) {
				$usuario = Usuario::login($ID_usuario,$pass);
				if($usuario){
					$_SESSION['login'] = true;
					$_SESSION['ID_usuario'] = $ID_usuario;
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
