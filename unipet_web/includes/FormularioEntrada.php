<?php
	
	namespace es\ucm\fdi\aw;
	require_once "usuarioUtils.php";
	require_once "config.php";
	require_once "Entrada.php";
	class FormularioEntrada extends Form {

		protected function generaCamposFormulario($datos, $errores = array())
	    {
			if (!estaLogado() || !isset($_GET['id'])) {
				$html = "<h2> Para comentar a este hilo debes de iniciar sesión </h2>";
				return $html;
			}
			$idUsuario = idUsuarioLogado();
			$nombreUsuario = nombreLogado();
			$apellidoUsuario = apellidoLogado();
			$id_hilo = $_GET['id'];
	    	$html = <<<EOS
			<fieldset>
				<hr>
				<div>
					<input class="control" type="text" name="id_hilo" value="$id_hilo" readonly/>
					<input class="control" type="text" name="id_usuario" value="$idUsuario" readonly/>
					<div>
						<p> <a href = "perfil_user.php?id=$idUsuario">$nombreUsuario $apellidoUsuario</a> ha dicho: </p>
					</div>
					<div>
						<input type="text" name="comentario" />
					</div>
				</div>	
				<div><button type="submit">Comentar</button></div>
			</fieldset>
EOS;
	    	return $html;
	  	}

		protected function procesaFormulario($datos)
		{
			$errores = array();
			$comentario =  $datos['comentario'] ?? null;
			$id_hilo = $datos['id_hilo'] ?? null;
			$id_usuario = $datos['id_usuario'] ?? null;
			
			if (empty($id_hilo)) $errores['id_hilo'] = "NO SE ENCUENTRA EL ID DEL HILO";
			if (empty($id_usuario)) $errores['id_usuario'] = "NO SE ENCUENTRA EL ID DEL USUARIO";
			if (empty($comentario)) $errores['comentario'] = "¡Debes de comentar algo!";
			
			if(count($errores)==0){
				$entrada = Entrada::nuevaEntrada($id_usuario,$id_hilo,$comentario,date('d-m-y'));
				if(!$entrada) $errores['BD']="ERROR AL INSERTAR COMENTARIO";
				else $errores = "hiloForo.php?id=$id_hilo";
			}
			
			return $errores;
			
		}
	}
?>
