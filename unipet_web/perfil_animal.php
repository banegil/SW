<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/usuarioUtils.php';


$tituloPagina = 'Perfil Animal';
$contenidoPrincipal = '<link rel="stylesheet" type="text/css" href="perfil.css" />';
$idSes = $_GET['id'];
$contenidoPrincipal.= "<div id='perfilcontenedor'>";
$animal = es\ucm\fdi\aw\Animal::buscaPorID($idSes);
if ($animal == null) $contenidoPrincipal .= "<h2> No se ha encontrado con ningún animal  </h2>";
else {
    $tituloPagina = $animal->getNombre();
    $protectora = es\ucm\fdi\aw\Protectora::buscaProtectoraPorId($animal->getProtectora());
    //echo '<img src="data:imagenes;base64,' . base64_encode($animal->getImagen()) . ' "width=15%";>';
    $contenidoPrincipal .= "<div id='contenedorNombre'>";
	if(file_exists(FICHERO_IMGANI.'/'.$animal->getID().'.jpg')){
		$contenidoPrincipal .= "<img class='fotoAnimal' src=img/ani/".$animal->getID().".jpg alt=Foto animal".$animal->getID()."/>";
		if(permisosVoluntario()){
			$contenidoPrincipal .="<p>Cambiar foto:</p>";
			$form = new es\ucm\fdi\aw\FormularioFotoAni($animal->getID());
			$contenidoPrincipal .= $form->gestiona();
		}
	}else{
		$contenidoPrincipal .= "<img class='fotoAnimal' src=img/ani/null.jpg alt=Foto animal".$animal->getID()."/>";
		if(permisosVoluntario()){
			$contenidoPrincipal .="<p>Añadir foto:</p>";
			$form = new es\ucm\fdi\aw\FormularioFotoAni($animal->getID());
			$contenidoPrincipal .= $form->gestiona();
		}
	}
    $contenidoPrincipal .=  "<p id='nombreAnimal'> NOMBRE: " . $animal->getNombre() . "</p>";
    if ($animal->getUrgente() && $animal->getId_propietario() == null) {
        $contenidoPrincipal .= "<h1>¡URGENTE!</h1>";
    }
    $contenidoPrincipal .= "</div>";
    $contenidoPrincipal .= "<div id='contenedorDatos'>";
    $contenidoPrincipal .=  "<p> TIPO: " . $animal->getTipo() . " </p>";
    $contenidoPrincipal .=    "<p> RAZA: " . $animal->getRaza() . " </p>";
    $contenidoPrincipal .=    "<p> SEXO: " . $animal->getSexo() . " </p>";
    $contenidoPrincipal .=    "<p> FECHA NACIMIENTO: " . $animal->getNacimiento() . " </p>";
    $contenidoPrincipal .=    "<p> FECHA INGRESO: " . $animal->getFecha_ingreso() . " </p>";
    if ($protectora == null) $contenidoPrincipal .=    "<p> PROTECTORA: Este animal no se encuentra en ninguna protectora o ha habido un error, contacte con un voluntario para más información </p>";
    else $contenidoPrincipal .=    '<a href = "protectora.php?id=' . $protectora->getID() . '">' . $protectora->getNombre() . '</a>';
    $contenidoPrincipal .="</div>";
    $contenidoPrincipal .= "<div id='botonesContenedor'>";
    if ($animal->getId_propietario() != null) {
        $usuario = es\ucm\fdi\aw\Usuario::buscaPorID_usuario($animal->getId_propietario());
        $contenidoPrincipal .= "<p> Historia feliz: " . $animal->getHistoria_feliz() . "</p>";
        $contenidoPrincipal .= "<p> Adoptado por  " . $usuario->getNombre() . "</p>";
        $contenidoPrincipal .= "<button type='button' class='boton' disabled>Adoptar</button>";
        $contenidoPrincipal .= "<button type='button'  class='boton'botondisabled>Apadrinar</button>";

        $contenidoPrincipal .= "<p> El animal está adoptado</p>";
    } else {
        if (estaLogado() && $animal->getId_propietario() == null) {
            $contenidoPrincipal .= <<<EOS
        <form action="adoption.php">
	    <input type="hidden" name="id" value="{$idSes}" />
            <input type="submit" class='boton' value="Adoptar" />
        <button class='boton' type="button">Apadrinar</button>
EOS;
            if ($_SESSION["tipo"] == "voluntario" || $_SESSION["tipo"] == "veterinario") {
                $contenidoPrincipal .= " <a class='boton' href=fichaVista.php?id={$idSes}> Ficha Medica</a>";
            }
            if ($_SESSION["tipo"] == "voluntario") { // modificar
                $contenidoPrincipal .= <<<EOS
                <a class='boton' href=modificaPerfilAnimal.php?id={$idSes}> Editar perfil</a>
            </div>
        </div>
EOS;
            }
        } else {
            $contenidoPrincipal .= <<<EOS
            <button type="button" class="boton" disabled>Adoptar</button>
            <button type="button" class="boton">Apadrinar</button>
            <p> No estas logueado</p>
            </div>
        </div>
EOS;
        }
    }
}
require __DIR__ . '/includes/plantillas/plantilla.php';
