<?php

function checkID(){ // comprobamos si hay un ID
    return (isset($_GET["id"]));
}

function idSession(){
    $result = false;
    if (checkID()) {
      $result = $_GET["id"];
    }
    $_SESSION["idAnimal"] = $result;
    return $result;
}