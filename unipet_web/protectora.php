<?php 
	require_once __DIR__.'/includes/config.php';
	
	$id = $_GET['id'];
	$tituloPagina = "Protectora";
	$protectora = es\ucm\fdi\aw\Protectora::buscaProtectoraPorId($id);
	if($protectora == null) $contenidoPrincipal = "<h1> PROTECTORA NO EXISTENTE </h1>";
	else {
		$tituloPagina = $protectora->getNombre() ;
		$contenidoPrincipal = '<h3>Nombre: '.$protectora->getNombre().'</h3>';
		$contenidoPrincipal.= '<h3>Dirección: '.$protectora->getDireccion().'</h3>';
		$contenidoPrincipal.= '<h3>Telefono: '.$protectora->getTelefono().'</h3>';
		
		
		if( isset($_SESSION['tipo']) && ($_SESSION['tipo'] == "voluntario" || $_SESSION['tipo'] == "administrador")){
			$_SESSION['idProtectora'] = $id;
				
				$contenidoPrincipal.= <<<EOS
				<form id="modProtectora" action="./procesarAddProtectora.php" method="POST">
					<form action="modificaProtectora.php">
						<input type="submit" value="Modificar protectora" />
					</form>
					
				</div>;
			</form>;
EOS;
		}
	}
require __DIR__.'/includes/plantillas/plantilla.php';
?>
