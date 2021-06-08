<?php

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Hilo';
$contenidoPrincipal = "HOLA";

if(isset($_GET['hilo'])){
	$id_hilo = $_GET['hilo'];
	$hilo = es\ucm\fdi\aw\Hilo::getHilo($id_hilo);
	if ($hilo != null){
		
		$autor=es\ucm\fdi\aw\Usuario::buscaPorID_usuario($hilo->getID_usuario());
		$nombreAutor=$autor->getNombre();
		$apellidoAutor= $autor->getApellido();
		$idAutor=$hilo->getID_usuario();
		$comentarioAutor=$hilo->getComentario();
		$fechaAutor=$hilo->getFecha();
		$tituloHilo = $hilo->getTitulo();
		$comienzoHilo = <<<EOS
			<h2>$tituloHilo</h2>
			<div>
				<div>
					<p> <a href = "perfil_user.php?id=$idAutor">$nombreAutor $apellidoAutor</a> ha dicho: </p>
				</div>
				<div>
					<p> $comentarioAutor </p>
				</div>
			</div>
EOS;
		
		$entradas=es\ucm\fdi\aw\Entrada::getEntradasPorHilo($id_hilo);
		if($entradas != null)$cantEntradas = count($entradas); 
		else $cantEntradas=0;
		$i = 0;
		$respuestas = "";
		for($i = 0; $i < $cantEntradas; $i++){
			$usuario=es\ucm\fdi\aw\Usuario::buscaPorID_usuario($entradas[$i]->getID_usuario());
			$nombreUsuario=$usuario->getNombre();
			$apellidoUsuario= $usuario->getApellido();
			$idUsuario=$usuario->getID();
			$comentarioUsuario=$entradas[$i]->getComentario();
			$fechaUsuario=$entradas[$i]->getFecha();
			$respuestas.=<<<EOS
			<hr>
				<div>
					<div>
						<p> <a href = "perfil_user.php?id=$idUsuario">$nombreUsuario $apellidoUsuario</a> ha dicho: </p>
					</div>
					<div>
						<p> $comentarioUsuario </p>
					</div>
				</div>					
EOS;
		}
		
		$contenidoPrincipal=<<<EOS
			$comienzoHilo	
			$respuestas
EOS;
		
	}else $contenidoPrincipal = "<h1> ERROR CON EL HILO </h1>";
}
else{
	$contenidoPrincipal = <<<EOS
	<h1>No se está pasando el numero del hilo</h1>
EOS;
}

require __DIR__.'/includes/plantillas/plantilla.php';
