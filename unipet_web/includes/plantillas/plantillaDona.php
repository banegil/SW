<!DOCTYPE html>

<html>
 <head>
	<link rel="stylesheet" type="text/css" href="css/stylusDona.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?= $tituloPagina ?></title>
 </head>
 
 <body>
	 
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

 </body>
 
</html>
