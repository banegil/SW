<?php
	
	function listaAnimales($animales){
		$html = "";
		if($animales == false){
			$html = '<p> No hay animales disponibles </p>';
			return $html;
		}
		$cantidad = count($animales);
		
		$html.= '<div class="row">';
		for($i = 0; $i < $cantidad; $i+=2){
			$html.= '<div class="column">';
			$html .= '<h3 id="'.$animales[$i].'"><a href = "perfil_animal.php?id='.$animales[$i].'">'.$animales[$i+1].'</a></h3>';
			$html .= '<a href = "perfil_animal.php?id='.$animales[$i].'"><img src="img/'.$animales[$i].'.jpg" alt="Foto animal'.$animales[$i].'"/></a>';
			$html.= '</div>';
		}
		$html.= '</div>';
		
		return $html;
	}
	
	function listaAnimalesMuestra($animales,$muestra){
		$html = '';
		if($animales == false){
			$html = '<p> No hay animales disponibles </p>';
			return $html;
		}
		
		if(count($animales) < $muestra * 2) $cantidad = count($animales);
		else $cantidad = $muestra * 2;
		
		$html.= '<div class="row">';
		for($i = 0; $i < $cantidad; $i+=2){ 
			$html.= '<div class="column">';
			$html.= '<h3 id="'.$animales[$i].'"><a href = "perfil_animal.php?id='.$animales[$i].'">'.$animales[$i+1].'</a></h3>';
			$html.= '<a href = "perfil_animal.php?id='.$animales[$i].'"><img src="img/'.$animales[$i].'.jpg" alt="Foto animal'.$animales[$i].'"/></a>';
			$html.= '</div>';
		}
		$html.= '</div>';
		return $html;
	}
	
	
?>