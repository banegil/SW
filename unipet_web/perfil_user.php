
<?php
require_once __DIR__."/includes/Usuario.php";
require_once __DIR__."/includes/AnimalDB.php";

$tituloPagina = 'PerfilUsuario';
$contenidoPrincipal = '<link rel="stylesheet" type="text/css" href="perfil.css" />';

$contenidoPrincipal.= "<div id='perfilcontenedor'>";
$usuario = null;
$esMiPerfil = false;
if(isset($_GET['id']) && $_GET['id']!=null){
	$idUsu = $_GET['id'];
	$usuario = es\ucm\fdi\aw\Usuario::buscaPorID($idUsu);
}
else if(estaLogado()){
    $idUser = idUsuarioLogado();
    if($idUser != false){ // comprobamos si hemos recibido un id de usuario
        $usuario = es\ucm\fdi\aw\Usuario::buscaPorID($idUser); // funcion estática para buscar en la base de datos al usuario por el dni
	}
}	
       
if($usuario != null){ // comprobamos si el usuario esta en la base de datos
	if ($usuario->getID() == idUsuarioLogado() || permisosVoluntario()) $esMiPerfil = true;
    if ($esMiPerfil)$contenidoPrincipal .="<p> DNI: ".$usuario->getDni(). "</p>";
    // aqui iria el div para foto nombre y apellido
    $contenidoPrincipal .= "<div id='contenedorNombre'>";
    $contenidoPrincipal .= "<div id='contenedorNameApellido'>";
    $contenidoPrincipal .="<p> NOMBRE: ".$usuario->getNombre(). "</p>";
	$contenidoPrincipal .="<p> APELLIDO: ".$usuario->getApellido(). "</p>";
    $contenidoPrincipal .= "</div>";
    $contenidoPrincipal .= "</div>";
    // contenedor con el resto de datos
    $contenidoPrincipal .= "<div id='contenedorDatos'>";
    $contenidoPrincipal .= "<div id='contenedorDatosIzquierda'>";
    if ($esMiPerfil)$contenidoPrincipal .= "<p> TELEFONO: ".$usuario->getTelefono(). "</p>";
    if ($esMiPerfil)$contenidoPrincipal .= "<p> EMAIL: ".$usuario->getEmail(). "</p>";
    $contenidoPrincipal .= "<p> FECHA NACIMIENTO : ".$usuario->getNacimiento(). "</p>";
    if ($esMiPerfil)$contenidoPrincipal .= "<p> DIRECCION: ".$usuario->getDireccion(). "</p>";
    $contenidoPrincipal .= "<p> TIPO: ".$usuario->getTipo(). "</p>";
    $contenidoPrincipal .= "</div>";
    //animales adoptados y apadrinados
	if ($esMiPerfil){
    $contenidoPrincipal .= "<div id='contenedorDatosDerecha'>";
    $adoptado = Animal::getAdoptados($usuario->getDni());
    $contenidoPrincipal .= "<p> ANIMALES ADOPTADOS:" ."</p>";
    if($adoptado != false){
        foreach($adoptado as $i){ 
        $contenidoPrincipal .= "<p>" .$i->getNombre()."</p>";
        }
    } else $contenidoPrincipal .= "<p> Ninguno </p>";			
    $apadrinado = Animal::getApadrinados($usuario->getDni());
    $contenidoPrincipal .="<p> ANIMALES APADRINADOS:" ."</p>";
    if($apadrinado != false){
        foreach($apadrinado as $i){ 
			$contenidoPrincipal .= "<p>" .$i->getNombre()."</p>";
        }
    } else $contenidoPrincipal .= "<p> Ninguno </p>";
    $contenidoPrincipal .= "</div>";
    $contenidoPrincipal .= "</div>";
	}
	if($usuario->getID() == idUsuarioLogado()){
		$contenidoPrincipal .= "<div id='botonesContenedor'>";
		$contenidoPrincipal .= <<<EOS
		<a class='boton' href=editarPerfilUsuario.php> Editar perfil</a>
EOS;
        $contenidoPrincipal .= "</div>";
    }
}
else{
    $contenidoPrincipal .= "<h2>El usuario no existe</h2>";
}

$contenidoPrincipal .= "</div>";
 require __DIR__ . '/includes/plantillas/plantilla.php';
