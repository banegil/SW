<?php
require_once __DIR__ . '/includes/AnimalDB.php';
require_once __DIR__ . '/includes/UsuarioDB.php';
require_once __DIR__ . '/includes/Usuario.php';
require_once __DIR__ . '/includes/ProtectoraDB.php';


$tituloPagina = 'Perfil Animal';
$contenidoPrincipal = '<link rel="stylesheet" type="text/css" href="perfil.css" />';
$idSes = $_GET['id'];
$contenidoPrincipal.= "<div id='perfilcontenedor'>";
$animal = Animal::buscaPorID($idSes);
if ($animal == null) $contenidoPrincipal .= "<h2> No se ha encontrado con ningún animal  </h2>";
else {
    $tituloPagina = $animal->getNombre();
    $protectora = Protectora::buscaProtectoraPorId($animal->getProtectora());
    //echo '<img src="data:imagenes;base64,' . base64_encode($animal->getImagen()) . ' "width=15%";>';
    $contenidoPrincipal .= "<div id='contenedorNombre'>";
    $contenidoPrincipal .=  "<p id='nombreAnimal'> NOMBRE: " . $animal->getNombre() . "</p>";
    if ($animal->getUrgente() && $animal->getID_propietario() == null) {
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
    if ($animal->getID_propietario() != null) {
        $usuario = Usuario::buscaPorID($animal->getID_propietario());
        $contenidoPrincipal .= "<p> Historia feliz: " . $animal->getHistoria_feliz() . "</p>";
        $contenidoPrincipal .= "<p> Adoptado por  " . $usuario->getNombre() . "</p>";
        $contenidoPrincipal .= "<button type='button' class='boton' disabled>Adoptar</button>";
        $contenidoPrincipal .= "<button type='button'  class='boton'botondisabled>Apadrinar</button>";

        $contenidoPrincipal .= "<p> El animal está adoptado</p>";
    } else {
        if (estaLogado() && $animal->getID_propietario() == null) {
            $contenidoPrincipal .= <<<EOS
        <form action="formularioAdopcion.php">
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
