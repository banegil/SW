<?php 
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/ProtectoraDB.php';
	require("cabecera.php");
	
	
	$id = $_GET['id'];
	
	$protectora = Protectora::buscaProtectoraPorId($id);

	echo '<h3>Nombre: '.$protectora->getNombre().'</h3>';
	echo '<h3>Dirección: '.$protectora->getDireccion().'</h3>';
	echo '<h3>Telefono: '.$protectora->getTelefono().'</h3>';
	
	
	if( isset($_SESSION['tipo']) && ($_SESSION['tipo'] == "voluntario" || $_SESSION['tipo'] == "administrador")){
		echo '<form id="modProtectora" action="./procesarAddProtectora.php" method="POST">';
			$_SESSION['id'] = $id;
			?>
				<form action="modificaProtectora.php">
					<input type="submit" value="Modificar protectora" />
				</form>
				
				<?php
			echo '</div>';
		echo '</form>';
	}
	require("pie.php");
?>