<?php

function checkID(){ // comprobamos si hay un ID
    return (isset($_GET["id"]));
}

function idSession(){ // Necesario para acceder al contrato de adopciรณn o de apadrinamiento desde el perfil del animal
    $result = false;
    if (checkID()) {
      $result = $_GET["id"];
    }
    return $result;
}