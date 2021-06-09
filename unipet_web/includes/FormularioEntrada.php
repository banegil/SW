<?php
	
	namespace es\ucm\fdi\aw;
	require_once "usuarioUtils.php";
	
	class FormularioEntrada extends Form {
		
		private $id_hilo;
		private $idUsu;
		
		public function __construct($idUsu,$id_hilo) {
			
			$this->id_hilo = $id_hilo;
			$this->idUsu = $idUsu;
			
			$opciones = array('action' => 'hiloForo.php?hilo='. $this->id_hilo);
			
			parent::__construct("1", $opciones);
		}

		protected function generaCamposFormulario($datos, $errores = array())
	    {
			if (!estaLogado()) {
				$html = "<h2> Para comentar a este hilo debes de iniciar sesión </h2>";
				return $html;
			}
			$idUsuario = idUsuarioLogado();
			$nombreUsuario = nombreLogado();
			$apellidoUsuario = apellidoLogado();
	    	$html = <<<EOS
			<fieldset>
				<div>
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
			
			if (empty($comentario)) $errores[] = "¡Debes de comentar algo!";
			
			if(count($errores)===0){
				$entrada = Entrada::nuevaEntrada($this->idUsu,$this->id_hilo,$comentario,date("Y-m-d H:i:s"));
				if(!$entrada) $errores[]="ERROR AL INSERTAR COMENTARIO";
				else $errores = 'hiloForo.php?hilo='. $this->id_hilo;
			}
			
			return $errores;
			
		}
	}
?>
