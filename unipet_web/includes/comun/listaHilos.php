<?php
function listaHilosPaginado($hilos,$numPorPagina,$numPagina){
	if ($hilos == null) {
		$html = "<p> No se han encontrado hilos </p>";
		return $html;
	}	
    $html = '<ul>';
    $numHilos = count($hilos);
    $haySiguientePagina = false;
    if ($numHilos > $numPorPagina) {
        $numHilos = $numPorPagina;
        $haySiguientePagina = true;
    }
    $idx = 0;
    while($idx < $numHilos) {
        $hilo = $hilos[$idx];
		$titulo = $hilo->getTitulo();
        $href = "hiloForo.php?hilo=".$hilo->getID()."";
        $html .= '<li>';
        $html .= "<a href=\"$href\">$titulo</a>";
        $html .= '</li>';
        $idx++;
    }
    $html .= '</ul>';

    // Controles de paginacion
    $clasesPrevia='disabled';
    $clasesSiguiente = 'disabled';
    $hrefPrevia = '';
    $hrefSiguiente = '';

    if ($numPagina > 1) {
        // Seguro que hay mensajes anteriores
        $paginaPrevia = $numPagina - 1;
        $clasesPrevia = '';
        $hrefPrevia = 'href="' . RUTA_APP.'/mensajes.php?id='.$idMensajePadre . '&numPagina='. $paginaPrevia . '"&numPorPagina='. $numPorPagina . '"';
    }

    if ($haySiguientePagina) {
        // Puede que haya mensajes posteriores
        $paginaSiguiente = $numPagina + 1;
        $clasesSiguiente = '';
        $hrefSiguiente = 'href="' . RUTA_APP.'/mensajes.php?id='.$idMensajePadre . '&numPagina='. $paginaSiguiente . '&numPorPagina='. $numPorPagina . '"';
    }

    $html .=<<<EOS
        <div>
            Página: $numPagina, <a class="boton $clasesPrevia" $hrefPrevia>Previa</a><a class="boton $clasesSiguiente" $hrefSiguiente>Siguiente</a>
        </div>
EOS;

    return $html;
	
}

	function listaHilosMuestra($hilos, $muestra){
		$html = '';
		if($hilos == false){
			$html.= '<p>No hay ningún hilo actualmente</p>';
		}
		else{
			if(count($hilos)<= $muestra)
				$cantidad = count($hilos);
			else
				$cantidad = $muestra;
			
			$html.= '<hr />';
			for($i = 0; $i < $cantidad; $i++){ 
				$html.= '<h3>- <a href = "hiloForo.php?hilo='.$hilos[$i]->getID().'">'.$hilos[$i]->getTitulo().'</a></h3>';
				$html.= '<p>'.$hilos[$i]->getComentario().'</p>';
				$html.= '<hr />';
			}
		}
		return $html;
	}


?>