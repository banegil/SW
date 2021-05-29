<!DOCTYPE html>
<header>
<!-- Aqui va el script del menu de cabecera-->
<meta charset= "utf-8">
<title>Perfil Historia Feliz</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />
</header> 


<body>
    
<?php
 require("cabecera.php");
?>
<?php
 require_once __DIR__.'/includes/Animal.php';
 require_once __DIR__.'/includes/AnimalDB.php'; 
 require_once __DIR__.'/includes/Usuario.php';
 require_once __DIR__.'/includes/ProtectoraDB.php';


if(idSession()){
    $sesion = idSession();
    $animal = Animal::buscaPorID($sesion);
    $usuario = Usuario::buscaPorDNI($animal->getDni_propietario());
    //echo '<img src="data:imagenes;base64,' . base64_encode($animal->getImagen()) . ' "width=15%";>';
    echo "<p> NOMBRE: ".$animal->getNombre(). "</p>";
    //echo "<p> ID: ".$animal->getID(). "</p>";
    echo "<p> La hermosa historia de " .$animal->getNombre(). " y su dueñ@ " .$usuario->getNombre(). "</p>";
    echo "<p> Historia feliz: ".$animal->getHistoria_feliz(). "</p>";
    }
else{
    echo "<h2> No hay ningún animal que corresponda a la historia seleccionada </h2>";
}
?>
<?php
 require("pie.php");
?>
</body>



</html>