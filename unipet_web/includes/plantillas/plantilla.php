<!DOCTYPE html>

<html>
 <head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<link rel="stylesheet" type="text/css" href="css/cabecera.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?= $tituloPagina ?></title>
 </head>
 
 <body>
	<div id="contenedor">

	<?php
		require("includes/comun/cabecera.php");
	?>
	
	<main>
		<article>
 
		<?= $contenidoPrincipal ?>
		
		</article>
	</main>
	
	<?php
		require("includes/comun/pie.php");
	?>

	</div>
 </body>
 
</html>
