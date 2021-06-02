<?php   
 require_once __DIR__.'/includes/AnimalDB.php'; 
 require_once __DIR__.'/includes/UsuarioDB.php';
 require_once __DIR__.'/includes/Usuario.php';
 require_once __DIR__.'/includes/ProtectoraDB.php';

$tituloPagina = 'Perfil Animal';
$contenidoPrincipal = "";
$idSes = $_GET['id'];
$animal = Animal::buscaPorID($idSes);
if ($animal == null) $contenidoPrincipal .= "<h2> No se ha encontrado con ningún animal  </h2>";
else {
	$tituloPagina = $animal->getNombre();
	$protectora = Protectora::buscaProtectoraPorId($animal->getProtectora());
    //echo '<img src="data:imagenes;base64,' . base64_encode($animal->getImagen()) . ' "width=15%";>';
	if($animal->getUrgente() && $animal->getDni_propietario() == null){
       $contenidoPrincipal .="<h1>¡URGENTE!</h1>";
    } 
    $contenidoPrincipal .=  "<p> NOMBRE: ".$animal->getNombre(). "</p>";
    $contenidoPrincipal .=  "<p> TIPO: ".$animal->getTipo()." </p>";
	$contenidoPrincipal .=	"<p> RAZA: ".$animal->getRaza()." </p>";
	$contenidoPrincipal .=	"<p> SEXO: ".$animal->getSexo()." </p>";
	$contenidoPrincipal .=	"<p> FECHA NACIMIENTO: ".$animal->getNacimiento()." </p>";
	$contenidoPrincipal .=	"<p> FECHA INGRESO: ".$animal->getFecha_ingreso()." </p>";
	if ($protectora == null) $contenidoPrincipal .=	"<p> PROTECTORA: Este animal no se encuentra en ninguna protectora o ha habido un error, contacte con un voluntario para más información </p>";
	else $contenidoPrincipal .=	'<a href = "protectora.php?id='.$protectora->getID().'">'.$protectora->getNombre().'</a>';
    if($animal->getDni_propietario() != null){
        $usuario = Usuario::buscaPorDNI($animal->getDni_propietario());
		$contenidoPrincipal .= "<p> Historia feliz: ".$animal->getHistoria_feliz()."</p>";
        $contenidoPrincipal .= "<p> Adoptado por  ".$usuario->getNombre(). "</p>";
        $contenidoPrincipal .= "<button type='button' disabled>Adoptar</button>";
        $contenidoPrincipal .= "<button type='button' disabled>Apadrinar</button>";

     $contenidoPrincipal .="<p> El animal está adoptado</p>";
    }
    else{
        if(estaLogado() && $animal->getDni_propietario() == null){
		$contenidoPrincipal .= <<<EOS
        <form action="formularioAdopcion.php">
            <input type="submit" value="Adoptar" />
        </form>
        <button type="button">Apadrinar</button>
EOS;
            if(  $_SESSION["tipo"]=="voluntario"|| $_SESSION["tipo"]=="veterinario" ){
                $contenidoPrincipal .="<button type='button'>Ficha medica</button>";
            }
            if( $_SESSION["tipo"]=="voluntario"){ // modificar
				$contenidoPrincipal .= <<<EOS
                  <form method="GET" action="modificaPerfilAnimal.php">
                  <input type="hidden" name="id" value="<?=$idSes?>"/>
                  <input type="submit" name="action" value="Editar Perfil"/>
                </form>
EOS;
            }
        }
        else{
			$contenidoPrincipal .= <<<EOS
            <button type="button" disabled>Adoptar</button>
            <button type="button">Apadrinar</button>
            <p> No estas logueado</p>
EOS;
        }
    }
}
require __DIR__.'/includes/plantillas/plantilla.php';