<?php

require_once __DIR__.'/config.php';


class Animal
{
	
	public static function add($idAnimal, $nombre, $nacimiento, $tipo, $raza, $sexo, $peso, $ingreso, $protectora)
	{	
	   $animal = new Animal($idAnimal, $nombre, $nacimiento, $tipo, $raza, $sexo, $peso, $ingreso, $protectora, NULL, NULL,NULL);   
	   return $animal;
	}
	public static function actualizar($idAnimal, $nombre, $nacimiento, $tipo, $raza, $sexo, $peso, $ingreso, $protectora,$historia_feliz, $urgente)
	{	
	   $animal = new Animal($idAnimal, $nombre, $nacimiento, $tipo, $raza, $sexo, $peso, $ingreso, $protectora, $historia_feliz, NULL, $urgente);   
	   return $animal;
	}
	
    public static function buscaPorID($idAnimal)
    {
       $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM Animales WHERE ID='%s' ", $idAnimal); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $animal = new Animal($fila['ID'], $fila['nombre'], 
                                $fila['nacimiento'], $fila['tipo'], $fila['raza'],
                                $fila['sexo'], $fila['peso'], 
                                $fila['ingreso'], $fila['protectora'], 
                                $fila['historia'], $fila['DNI'], $fila['urgente']);
        $rs->free();
        return $animal;
       }
       return false;
    }

   public static function getAdoptados($dni){
      $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
         $query = sprintf("SELECT * FROM Animales WHERE DNI='%s' ",$dni); 
         $rs = $conn->query($query);
         if($rs && ($rs->num_rows >0)){
            $resultado = [];
            while($fila=$rs->fetch_assoc()){
               $animal = new Animal($fila['ID'], $fila['nombre'], 
               $fila['nacimiento'], $fila['tipo'], $fila['raza'],
               $fila['sexo'], $fila['peso'], 
               $fila['ingreso'], $fila['protectora'], 
               $fila['historia'], $fila['DNI'], $fila['urgente']);
               array_push($resultado, $animal);
               
            }
			$rs->free();           
            return $resultado;
         }
		 $rs->free();
         return false;     
  }

  public static function getApadrinados($dni){
   $app = Aplicacion::getSingleton();
   $conn = $app->conexionBd();
   $query = sprintf("SELECT anim.id, anim.nombre, anim.nacimiento, anim.tipo,anim.raza, anim.sexo, anim.peso, anim.ingreso, anim.protectora,anim.historia, anim.DNI
    FROM Animales anim JOIN Apadrinados apa ON anim.id = apa.id JOIN Usuarios usu on apa.dni = usu.dni   WHERE usu.dni='%s' ",$dni); 
   $rs = $conn->query($query);
   if($rs && ($rs->num_rows >0)){
      $resultado = [];
      while($fila=$rs->fetch_assoc()){
         $animal = new Animal($fila['id'], $fila['nombre'], 
         $fila['nacimiento'], $fila['tipo'], $fila['raza'],
         $fila['sexo'], $fila['peso'], 
         $fila['ingreso'], $fila['protectora'], 
         $fila['historia'], $fila['DNI'], $fila['urgente']);
         array_push($resultado, $animal);
         
      }
	  $rs->free();
      return $resultado;
        
   }
	$rs->free(); 
   return false;     

  }

 public static function getEnAdopcion()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE DNI IS NULL");
	 $rs = $conn->query($query);
	 for($i = 0; $i < $rs->num_rows*2; $i+=2){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
		   $animales[$i+1] = $fila['nombre'];
	 }
	 $rs->free();
	 return $animales;
 }
 
 public static function getUrgentes()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE DNI IS NULL AND urgente != '0' ");
	 $rs = $conn->query($query);
	 for($i = 0; $i < $rs->num_rows*2; $i+=2){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
		   $animales[$i+1] = $fila['nombre'];
	 }
	 $rs->free();
	 return $animales;
 }
 
 public static function getUltimosAcogidos($tipoAnimal)
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE DNI IS NULL AND tipo = '%s' ORDER BY ingreso DESC", $tipoAnimal);
	 $rs = $conn->query($query);
	 for($i = 0; $i < $rs->num_rows*2; $i+=2){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
		   $animales[$i+1] = $fila['nombre'];
	 }
	 $rs->free();
	 return $animales;
 }
 
 public static function buscaAnimales($nombreAnimal,$tipoAnimal)
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
     $conn = $app->conexionBd();
	 $result = [];
	 /*
	 if ($nombreAnimal == null && $tipoAnimal == "Todos") $result = self::getAnimalsNameAndID();
	 else {*/
	   $query = sprintf("SELECT ID, nombre FROM animales WHERE ");
	   if ($nombreAnimal != null) $query .= "nombre LIKE '%".$nombreAnimal."%' AND ";
	   if ($tipoAnimal != "Todos") $query .= "tipo = '".$tipoAnimal."' AND ";
	   $query .= "DNI IS NULL ORDER BY nombre ASC";
	   $rs = $conn->query($query);
		 if ($rs) {
		  $i = 0;
		  while($fila = $rs->fetch_assoc()) {
			   $result[$i] = $fila['ID'];
			   $result[$i+1] = $fila['nombre'];
			   $i += 2;
		  }
		 $rs->free();
		 }
	
    //}

    return $result;
 }
   public static function getAnimalesAdoptados()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
     $conn = $app->conexionBd();
	 $result = [];
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE DNI IS NOT NULL ORDER BY fecha_adopcion DESC");
	 //$query .= "DNI IS NULL ORDER BY nombre ASC";
	 $rs = $conn->query($query);
	 if ($rs) {
		$i = 0;
		while($fila = $rs->fetch_assoc()) {
			 $result[$i] = $fila['ID'];
			 $result[$i+1] = $fila['nombre'];
			 $i += 2;
		}
		$rs->free();
	 }
    return $result;
 }

public static function insertaAnimal($animal)
{
	$result = false;

	$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	/*
	$query = sprintf("INSERT INTO Animales (ID, nombre, nacimiento, tipo, raza, sexo, peso, fecha_ingreso, protectora, historia_feliz, dni_propietario) VALUES (%d, %s, '%s', '%s', '%s', '%s', '%f', '%s', %d, '%s', '%s')"
	  , $animal->id
	  , $animal->nombre
	  , $animal->nacimiento
	  , $animal->tipo
	  , $animal->raza
	  , $animal->sexo
	  , $animal->peso
	  , $animal->fecha_ingreso
	  , $animal->protectora
	  , $animal->historia_feliz
	  , $animal->dni_propietario);
	  */
	$query = "INSERT INTO Animales (ID, nombre, nacimiento, tipo, raza, sexo, peso,ingreso, protectora, historia, dni)
	VALUES ($animal->id, '$animal->nombre', $animal->nacimiento, '$animal->tipo', '$animal->raza', '$animal->sexo', '$animal->peso', $animal->fecha_ingreso, '$animal->protectora', NULL, NULL )";
	$result = $conn->query($query);
	
	if ($result) {
	  $result = $animal;
	} else {

	  error_log($conn->error); 
	}
	
	return $result;
}

/**
 * update animal
 */ 
  
public static function actualizaAnimal($animal)
{
	$result = false;

	$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	$query = sprintf("UPDATE animales SET  nombre = '%s', nacimiento = '%s', tipo = '%s', raza = '%s', sexo = '%s', peso = %d, ingreso = '%s', protectora = '%d', historia = '%s', dni = '%s' WHERE ID = %d"
	
	  , $animal->nombre
	  , $animal->nacimiento
	  , $animal->tipo
	  , $animal->raza
	  , $animal->sexo
	  , $animal->peso
	  , $animal->fecha_ingreso
	  , $animal->protectora
	  , $animal->historia_feliz
	  , $animal->dni_propietario
	  , $animal->id);
	$result = $conn->query($query);
	if (!$result) {
	  error_log($conn->error);  
	} else if ($conn->affected_rows != 1) {
	  error_log("Se han actualizado los datos '$conn->affected_rows' !");
	}
	return $result;
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
private $imagen;
private $urgente;

private function __construct($id, $nombre, $nacimiento,
                             $tipo, $raza, $sexo, $peso,
                             $fecha_ingreso, $protectora,
                              $historia_feliz, $dni_propietario, $urgente)
                            
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
   $this->urgente = $urgente;
}





public function getUrgente(){
	return $this->urgente;
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

public static function getPerrosEnAdopcion()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE tipo = 'perro' AND dni IS NULL"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i+=1){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
	 }
	 $rs->free();
	 
	 return $animales;
 }
  public static function getPerrosAdopdatos()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE tipo = 'perro' AND dni IS NOT NULL"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i+=1){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
	 }
	 $rs->free();
	 
	 return $animales;
 }
  public static function getGatosEnAdopcion()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE tipo = 'gato' AND dni IS NULL"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i+=1){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
	 }
	 $rs->free();
	 
	 return $animales;
 }
 
  public static function getGatosAdoptados()
 {
	 $animales = array();
	 $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	 $query = sprintf("SELECT ID, nombre FROM animales WHERE tipo = 'gato' AND dni IS NOT NULL"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows; $i+=1){
           $fila = $rs->fetch_assoc();
		   $animales[$i] = $fila['ID'];
	 }
	 $rs->free();
	 
	 return $animales;
 }

 public function guarda()
  {
    if (!self::buscaPorID($this->id)) {
      self::insertaAnimal($this);
    } else {
      self::actualizaAnimal($this);
    }

    return $this;
  }
  public function actualiza(){
    if (self::buscaPorID($this->id)) {
		self::actualizaAnimal($this);
	  } 
    }
 

}