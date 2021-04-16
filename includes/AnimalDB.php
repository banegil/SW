<?php

require_once __DIR__.'/config.php';


class Animal
{
    public static function buscaPorID($idAnimal)
    {
       $conn = getConexionBD();
       $query = sprintf("SELECT * FROM Animales WHERE ID='%s' ", $idAnimal); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $animal = new Animal($fila['ID'], $fila['nombre'], 
                                $fila['nacimiento'], $fila['tipo'], $fila['raza'],
                                $fila['sexo'], $fila['peso'], 
                                $fila['fecha_ingreso'], $fila['protectora'], 
                                $fila['historia_feliz'], $fila['dni_propietario']);
        $rs->free();
        return $animal;
       }
       return false;
    }



private $id;
private $nombre;
private $nacimiento;
private $tipo;
private $raza;
private $sexo;
private $peso;
private $fecha_ingreso;
private $protectora;
private $historia_feliz;
private $dni_propietario;

private function __construct($id, $nombre, $nacimiento,
                             $tipo, $raza, $sexo, $peso,
                             $fecha_ingreso, $protectora,
                              $historia_feliz, $dni_propietario)
                            
{
   $this->id = $id;
   $this->nombre = $nombre;
   $this->nacimiento = $nacimiento;
   $this->raza = $raza;
   $this->tipo = $tipo;
   $this->sexo = $sexo;
   $this->peso = $peso;
   $this->fecha_ingreso = $fecha_ingreso;
   $this->protectora = $protectora;
   $this->historia_feliz = $historia_feliz;
   $this->dni_propietario = $dni_propietario;
}




/**
 * Get the value of id
 */ 
public function getId()
{
return $this->id;
}

/**
 * Set the value of id
 *
 * @return  self
 */ 
public function setId($id)
{
$this->id = $id;

return $this;
}

/**
 * Get the value of nombre
 */ 
public function getNombre()
{
return $this->nombre;
}

/**
 * Set the value of nombre
 *
 * @return  self
 */ 
public function setNombre($nombre)
{
$this->nombre = $nombre;

return $this;
}

/**
 * Get the value of nacimiento
 */ 
public function getNacimiento()
{
return $this->nacimiento;
}

/**
 * Set the value of nacimiento
 *
 * @return  self
 */ 
public function setNacimiento($nacimiento)
{
$this->nacimiento = $nacimiento;

return $this;
}

/**
 * Get the value of tipo
 */ 
public function getTipo()
{
return $this->tipo;
}

/**
 * Set the value of tipo
 *
 * @return  self
 */ 
public function setTipo($tipo)
{
$this->tipo = $tipo;

return $this;
}

/**
 * Get the value of raza
 */ 
public function getRaza()
{
return $this->raza;
}

/**
 * Set the value of raza
 *
 * @return  self
 */ 
public function setRaza($raza)
{
$this->raza = $raza;

return $this;
}

/**
 * Get the value of sexo
 */ 
public function getSexo()
{
return $this->sexo;
}

/**
 * Set the value of sexo
 *
 * @return  self
 */ 
public function setSexo($sexo)
{
$this->sexo = $sexo;

return $this;
}

/**
 * Get the value of peso
 */ 
public function getPeso()
{
return $this->peso;
}

/**
 * Set the value of peso
 *
 * @return  self
 */ 
public function setPeso($peso)
{
$this->peso = $peso;

return $this;
}

/**
 * Get the value of fecha_ingreso
 */ 
public function getFecha_ingreso()
{
return $this->fecha_ingreso;
}

/**
 * Set the value of fecha_ingreso
 *
 * @return  self
 */ 
public function setFecha_ingreso($fecha_ingreso)
{
$this->fecha_ingreso = $fecha_ingreso;

return $this;
}

/**
 * Get the value of protectora
 */ 
public function getProtectora()
{
return $this->protectora;
}

/**
 * Set the value of protectora
 *
 * @return  self
 */ 
public function setProtectora($protectora)
{
$this->protectora = $protectora;

return $this;
}

/**
 * Get the value of historia_feliz
 */ 
public function getHistoria_feliz()
{
return $this->historia_feliz;
}

/**
 * Set the value of historia_feliz
 *
 * @return  self
 */ 
public function setHistoria_feliz($historia_feliz)
{
$this->historia_feliz = $historia_feliz;

return $this;
}

/**
 * Get the value of dni_propietario
 */ 
public function getDni_propietario()
{
return $this->dni_propietario;
}

/**
 * Set the value of dni_propietario
 *
 * @return  self
 */ 
public function setDni_propietario($dni_propietario)
{
$this->dni_propietario = $dni_propietario;

return $this;
}

/**
 * return an array of animals' ID or Name
 */ 
 
 /*public static function getAnimalsID()
{
	 
	 $animalesID = array();
	 
	 $conn = getConexionBD();
	 $query = sprintf("SELECT ID FROM animales"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i++){
           $fila = $rs->fetch_assoc();
		   $animalesID[$i] = $fila['ID'];
	 }
     $rs->free();
	 
	 return $animalesID;
 }
 
 public static function getAnimalsName()
{
	 
	 $animalesName = array();
	 
	 $conn = getConexionBD();
	 $query = sprintf("SELECT nombre FROM animales"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i++){
           $fila = $rs->fetch_assoc();
		   $animalesName[$i] = $fila['nombre'];
	 }
     $rs->free();
	 
	 return $animalesName;
 }*/
 
 public static function getAnimalsNameAndID()
 {
	 $animales = array();
	 $conn = getConexionBD();
	 $query = sprintf("SELECT ID, nombre FROM animales"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows*2; $i+=2){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
		   $animales[$i+1] = $fila['nombre'];
	 }
	 $rs->free();
	 
	 return $animales;
 }
}