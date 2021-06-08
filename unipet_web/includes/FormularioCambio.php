<?php
	
	namespace es\ucm\fdi\aw;
	
	class FormularioCambio extends Form {

		private $idAni;
		private $idUsu;
		
		public function __construct($idAni, $idUsu)
		{
			$this->idAni = $idAni;
			$this->idUsu = $idUsu;
			
			$opciones = array('action' => 'solicitud.php?idAni='. $this->idAni .'&idUsu='. $this->idUsu);
			
			parent::__construct("1", $opciones);
		}
		
		protected function generaCamposFormulario($datos, $errores = array())
	    {
			
	    	$html = <<<EOS
					<fieldset>
						<div><label>Estado: </label>
							<select name="estado">
							  <option value="EnTramite" selected>En tramite</option>
							  <option value="FaltDatos">Faltan datos</option>
							  <option value="PendCita">Pendiente de cita</option>
							  <option value="EsperaRes">Esperar respuesta</option>
							  <option value="Rechazado">Rechazar</option>
							  <option value="Aprobado">Aprobar</option>
							</select>
							<button type="submit">Enviar</button>
						</div>
					</fieldset>
EOS;
	    	return $html;
	  	}

	  	protected function procesaFormulario($datos)
	    {
			$errores = array();
			
	    	$contract = Contrato::buscaPorIDeID($this->idUsu,$this->idAni);
			
			if (!$contract) {
				$errores[] = "Error. No se ha encontrado el contrato.";
			}
			else{
				$contract->setEstado($datos['estado']);
				$contract->guarda();
				$errores = 'controlPanel.php';
			}
				
	        return $errores;
	    }
	}
?>