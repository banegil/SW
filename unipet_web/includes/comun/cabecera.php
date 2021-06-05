<header>
	<div class="header">
	
		<a href="index.php" id="header"><img src="img/Logo.jpg" alt="Foto Logo"></a>
		<?php
		require_once ("includes/AnimalDB.php");
		require_once ("includes/config.php");
		
		$gatosEnAdopcion = Animal:: getGatosEnAdopcion();
		$numGatos = count($gatosEnAdopcion);
		$gatosAdop = Animal:: getGatosAdoptados();
		$numGatosAdop = count($gatosAdop);
		$perrosEnAdopcion = Animal:: getPerrosEnAdopcion();
		$numPerros = count($perrosEnAdopcion);
		$perrosAdoptados = Animal:: getPerrosAdopdatos();
		$numPerrosAdop = count($perrosAdoptados);
		
		?>

		<p>Gatos en adopcion: <?php  printf($numGatos); ?> |
		Gatos adoptados: <?php  printf($numGatosAdop); ?> |
		Perros en adopción: <?php  printf($numPerros); ?> |
		Perros adoptados: <?php  printf($numPerrosAdop); ?>
		</p>
		
		<?php
		if (isset($_SESSION["login"])&& (($_SESSION["tipo"])=='voluntario' || ($_SESSION["tipo"])=='administrador')){
			echo "<h4><a href=controlPanel.php> Panel de control </a></h4>";
		}
		?>
		
		<?php 
		if(isset($_SESSION["login"]) && $_SESSION ["login"] == true){
			echo(htmlspecialchars(trim(strip_tags($_SESSION["nombre"]))));
		}
		?>		
		<a href=animalesAdopcion.php>Animales en adopción</a> |
		<a href=protectoras.php>Protectoras</a> |
		<a href=historiasFelices.php>Historias felices</a> |
		<a href=colabora.php>Colabora con nosotros</a> |
		<a href=foro.php>Foro</a>

		
		
	</div>
	
	<div class="saludo">

		<?php
			if (isset($_SESSION["DNI"])){
				echo '<a href="perfil_user.php">Perfil</a> | ';
				echo '<a href="logout.php">Cerrar sesión</a>';
			}
			else{
				echo '<a href="login.php">Iniciar sesión</a> | ';
				echo '<a href="register.php">Registrarse</a>';
			}
		?>
	</div>
		
	
</header>
