<!DOCTYPE html>
<head>
<!-- Aqui va el script del menu de cabecera-->
<meta charset= "utf-8">
<link rel="stylesheet" type="text/css" href="estilo.css" />
<title>Perfil Animal</title>
</head> 



<body>

<div id="contenedor">

<?php
require("cabecera.php");    
?>

<main>
	<article>
	
<?php
 require_once __DIR__.'/includes/Animal.php';
 require_once __DIR__.'/includes/AnimalDB.php'; 
 require_once __DIR__.'/includes/UsuarioDB.php';
 require_once __DIR__.'/includes/Usuario.php';
 require_once __DIR__.'/includes/ProtectoraDB.php';


if(idSession()){
    $idSes = idSession();
    $animal = Animal::buscaPorID(idSession());
    //echo '<img src="data:imagenes;base64,' . base64_encode($animal->getImagen()) . ' "width=15%";>';
    echo "<p> NOMBRE: ".$animal->getNombre(). "</p>";
    echo "   URGENTE: ";
    if($animal->getUrgente()){
       echo "URGENTE";
    }else{
        echo "NO URGENTE";
    }
   
    //echo "<p> ID: ".$animal->getID(). "</p>";
    echo "<p> TIPO: ".$animal->getTipo(). "</p>";
    echo "<p> RAZA: ".$animal->getRaza(). "</p>";
    echo "<p> SEXO: ".$animal->getSexo(). "</p>";
    echo "<p> FECHA NACIMIENTO: ".$animal->getNacimiento(). "</p>"; 
    echo "<p> FECHA INGRESO: ".$animal->getFecha_ingreso(). "</p>";
    $protectora = Protectora::buscaProtectoraPorId($animal->getProtectora());
    echo "<p> PROTECTORA: ".$protectora->getNombre()."  ".$protectora->getDireccion() ."</p>";
    echo "<p> Teléfono: ".$protectora->getTelefono()."</p>";
    if($animal->getHistoria_feliz() != null){
      
        echo "<p> Historia feliz: ".$usuario->getNombre(). "</p>";
    }
    if($animal->getDni_propietario() != null){
        $usuario = Usuario::buscaPorDNI($animal->getDni_propietario());
        echo "<p> DNI PROPIETARIO: ".$usuario->getNombre(). "</p>";
        ?>
        <button type="button" disabled>Adoptar</button>
        <button type="button" disabled>Apadrinar</button>
       
    <?php
     echo "<p> El animal esta adoptado</p>";
    }
    else{
        if(estaLogado() && $animal->getDni_propietario() == null){
           
        ?>
        <form action="formularioAdopcion.php">
            <input type="submit" value="Adoptar" />
        </form>
        <button type="button">Apadrinar</button>
        <?php
            if(  $_SESSION["tipo"]=="voluntario"|| $_SESSION["tipo"]=="veterinario" ){
                ?>
                <button type="button">Ficha medica</button>
                <?php
            }
            if( $_SESSION["tipo"]=="voluntario"){ // modificar
                ?>
                  <form method="GET" action="modificaPerfilAnimal.php">
                  <input type="hidden" name="id" value="<?=$idSes?>"/>
                  <input type="submit" name="action" value="Editar Perfil"/>
                </form>

                <?php
            }
        }
        else{
            ?>
            <button type="button" disabled>Adoptar</button>
            <button type="button">Apadrinar</button>
            <?php
             echo "<p> No estas logueado</p>";
        }
    }
    ?>
  
   <?php
}
else{
    echo "<h2> No hay ningún animal que corresponda a la imagen seleccionada </h2>";
}
?>

		</article>
	</main>
</div>

<?php
 require("pie.php");
?>

</body>

</html>