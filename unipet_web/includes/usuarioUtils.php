<?php

function estaLogado()
{
  return (isset($_SESSION["login"]) && ($_SESSION["login"] == true));
}

function idUsuarioLogado()
{
  $result = false;
  if (estaLogado()) {
    $result = $_SESSION['id'];
  }
  return $result;
}

function permisosAdministrador(){
	return isset($_SESSION['tipo']) && ($_SESSION["tipo"])=='administrador';
}

function permisosVoluntario(){
	return isset($_SESSION['tipo']) && (($_SESSION["tipo"])=='voluntario' || permisosAdministrador());
}

function permisosVeterinario(){
	return isset($_SESSION['tipo']) && (($_SESSION["tipo"])=='veterinario' || permisosVoluntario());
}

function calculaEdad($birthDate){
  $birth = explode("/", $birthDate);
  $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date("md")
  ? ((date("Y") - $birth[2]) - 1)
  : (date("Y") - $birth[2]));
  return $age;
}
