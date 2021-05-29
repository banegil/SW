<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/ContratoDB.php';
	
	function listaSolicitudes(){
		$solicitudes = Contrato:: getSolicitudes();
		$cantidad = count($solicitudes);
		 $html = '';
		 foreach($solicitudes as $i){ 
			$html .= '<h3><a href = "solicitud.php?id='.$i->getID().'&dni='.$i->getDNI().'">'.$i->getID().' - '.$i->getDNI().' ('.$i -> getEstado().')</a></h3>';
		  }
		 return $html;
	}
	?>