<?php

	function listaHilosMuestra($hilos, $muestra){
		$html = '';
		if($hilos == false){
			$html.= '<p>No hay ningún hilo actualmente</p>';
		}
		else{
			if(count($hilos)/3 <= $muestra)
				$cantidad = count($hilos);
			else
				$cantidad = $muestra;
			
			$html.= '<hr />';
			for($i = 0; $i < $cantidad; $i+=3){ 
				$html.= '<h3>- <a href = "hiloForo.php?hilo='.$hilos[$i+2].'">'.$hilos[$i].'</a></h3>';
				$html.= '<p>'.$hilos[$i+1].'</p>';
				$html.= '<hr />';
			}
		}
		return $html;
	}
?>