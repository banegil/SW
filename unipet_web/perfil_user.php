<!DOCTYPE html>
<html>
<header>
<!-- Aqui va el script del menu de cabecera-->
<meta charset= "utf-8">
<title>Perfil Usuario</title>
<link rel="stylesheet" type="text/css" href="estilo.css" />
</header> 

<body>
    
<div id="contenedor">
<?php
require_once __DIR__."/includes/Usuario.php";
require_once __DIR__."/includes/UsuarioDB.php";
require_once __DIR__."/includes/AnimalDB.php";

require("cabecera.php");
?>
	<main>
		<article>
<?php
if(estaLogado()){
    $idUser = idUsuarioLogado();
    if($idUser != false){ // comprobamos si hemos recibido un id de usuario
        $usuario = USUARIO::buscaPorDNI($idUser); // funcion estática para buscar en la base de datos al usuario por el dni
        //echo '<img src="data:imagenes;base64,' . base64_encode($usuario->getImagen()) . ' "width=15%";>';
        
        
        if($usuario !=false){ // comprobamos si el usuario esta en la base de datos
            echo "<p> DNI: ".$usuario->getDni(). "</p>";
            echo "<p> NOMBRE: ".$usuario->getNombre(). "</p>";
            echo "<p> APELLIDO: ".$usuario->getApellido(). "</p>";
            echo "<p> TELEFONO: ".$usuario->getTelefono(). "</p>";
            echo "<p> EMAIL: ".$usuario->getEmail(). "</p>";
            echo "<p> FECHA NACIMIENTO : ".$usuario->getNacimiento(). "</p>";
            echo "<p> DIRECCION: ".$usuario->getDireccion(). "</p>";
            echo "<p> TIPO: ".$usuario->getTipo(). "</p>";
            //animales adoptados y apadrinados
            $adoptado = Animal::getAdoptados($usuario->getDni());
            echo "<p> ANIMALES ADOPTADOS:" ."</p>";
            if($adoptado != false){
                foreach($adoptado as $i){ 
                echo "<p>" .$i->getNombre()."</p>";
                }
            } else echo "<p> Ninguno </p>";			
            $apadrinado = Animal::getApadrinados($usuario->getDni());
            echo "<p> ANIMALES APADRINADOS:" ."</p>";
            if($apadrinado != false){
                foreach($apadrinado as $i){ 
                echo "<p>" .$i->getNombre()."</p>";
                }
            } else echo "<p> Ninguno </p>";
        }
        else{
            echo "<h2>El usuario no existe</h2>";
        }
        ?>
        <form method="GET" action="editarPerfilUsuario.php">
            <input type="submit" name="action" value="Editar Perfil"/>
            <?php
        
    }
    else{
        echo "<h2>usuario no válido</h2>";
    }
}
else{
	echo "<h1> ¡NO SE HA INICIADO SESIÓN! </h1>";
}?>			</article>
		</main>
	</div>
<?php
require("pie.php");
    ?>
 
</body>
</html>