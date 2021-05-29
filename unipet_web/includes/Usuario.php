<?php

function estaLogado()
{
  return (isset($_SESSION["login"]) && ($_SESSION["login"] == true));
}

function idUsuarioLogado()
{
  $result = false;
  if (estaLogado()) {
    $result = $_SESSION["DNI"];
  }
  return $result;
}

function calculaEdad($birthDate){
  $birth = explode("/", $birthDate);
  $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date("md")
  ? ((date("Y") - $birth[2]) - 1)
  : (date("Y") - $birth[2]));
  return $age;
}

