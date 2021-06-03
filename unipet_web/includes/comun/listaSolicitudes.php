<?php
	function listaSolicitudes($solicitudes){
		//$solicitudes = Contrato:: getSolicitudes();
		if ($solicitudes == null) {
			$html = "<p> No se han encontrado solicitudes </p>";
			return $html;
		}
		$cantidad = count($solicitudes);
		$html = '';
		 foreach($solicitudes as $i){ 
			$html .= '<h3><a href = "solicitud.php?id='.$i->getID().'&dni='.$i->getDNI().'">'.$i->getID().' - '.$i->getDNI().' ('.$i -> getEstado().')</a></h3>';
		  }
		 return $html;
	}
	?>