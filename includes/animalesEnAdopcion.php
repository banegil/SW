<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/AnimalDB.php';

	/*$animalesID = Animal::getAnimalsID();                         *Alternativa*
	sort($animalesID);
	$animalesName = Animal::getAnimalsName();
	$cantidad = count($animalesID);*/
	
	/*for($i = 0; $i < $cantidad; $i++){
		echo '<h3 id="'.$animalesID[$i].'">'.$animalesName[$i].'</h3>';
		echo '<img src="img/'.$animalesID[$i].'.jpg" alt="Foto animal'.$animalesID[$i].'"/>';
	}*/
	
	$animales = Animal::getAnimalsNameAndID();
	$cantidad = count($animales);
	
	for($i = 0; $i < $cantidad; $i+=2){
		echo '<h3 id="'.$animales[$i].'"><a href = "perfil_animal.php?id='.$animales[$i].'">'.$animales[$i+1].'</a></h3>';
		echo '<a href = "perfil_animal.php?id='.$animales[$i].'"><img src="img/'.$animales[$i].'.jpg" alt="Foto animal'.$animales[$i].'"/></a>';
	}
	
	
?>