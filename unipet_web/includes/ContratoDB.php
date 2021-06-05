<?php

require_once __DIR__.'/config.php';

class Contrato
{
	public static function crea($dni, $id, $formulario)
	{
	   $contract = new Contrato($dni, $id, $formulario,"EnTramite", date('Y-m-d H:i:s'));
	   return $contract;
	}
	  
    public static function buscaPorDNIeID($dniUsuario,$idAnimal)
    {
       $app = es\ucm\fdi\aw\Aplicacion::getSingleton();
        $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM contrato_adopcion WHERE DNI='%s' AND ID='%s' ", $dniUsuario, $idAnimal); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $contract = new Contrato($fila['DNI'], $fila['ID'], 
                                $fila['formulario'], $fila['estado'], $fila['fecha']);
        $rs->free();
        return $contract;
       }
       return false;
    }

private $dni;
private $id;
private $formulario;
private $estado;
private $fecha;

private function __construct($dni, $id, $formulario, $estado, $fecha)
{
    $this->dni = $dni;
    $this->id = $id;
    $this->formulario = $formulario;
    $this->estado = $estado;
    $this->fecha = $fecha;
}

/**
 * Get the value of dni
 */ 
public function getDni()
{
return $this->dni;
}

/**
 * Get the value of id
 */ 
public function getId()
{
return $this->id;
}

/**
 * Get the value of formulario
 */ 
public function getFormulario()
{
return $this->formulario;
}

/**
 * Get the value of estado
 */ 
public function getEstado()
{
return $this->estado;
}

/**
 * Get the value of fecha
 */ 
public function getFecha()
{
return $this->fecha;
}

/**
 * set the value of formulario
 */ 
public function setFormulario($formulario)
{
$this->formulario = $formulario;
return true;
}

/**
 * set the value of estado
 */ 
public function setEstado($estado)
{
$this->estado = $estado;
return true;
}

/**
 * insert a new contract in DB
 */ 
 
public static function insertaContrato($contract)
{
	$result = false;

	$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	$query = sprintf("INSERT INTO contrato_adopcion (DNI, ID, formulario, estado, fecha) VALUES ('%s', %d, '%s', '%s', '%s')"
	  , $contract->dni
	  , $contract->id
	  , $contract->formulario
	  , $contract->estado
	  , $contract->fecha);
	$result = $conn->query($query);
	if ($result) {
	  $result = $contract;
	} else {
	  error_log($conn->error); 
	}
	
	return $result;
}

/**
 * update the state of a contract
 */ 
  
public static function actualizaContrato($contract)
{
	$result = false;

	$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	$query = sprintf("UPDATE contrato_adopcion SET formulario = '%s', estado = '%s', fecha = '%s' WHERE DNI = '%s' AND ID = %d"
	  , $contract->formulario
	  , $contract->estado
	  , $contract->fecha
	  , $contract->dni
	  , $contract->id);
	$result = $conn->query($query);
	if (!$result) {
	  error_log($conn->error);  
	} else if ($conn->affected_rows != 1) {
	  error_log("Se han actualizado '$conn->affected_rows' !");
	}

	return $result;
}

/**
 * remove a contract
 */ 
 
public static function borraContratoPorDNIeID($dniUsuario,$idAnimal)
{
    $result = false;

    $app = es\ucm\fdi\aw\Aplicacion::getSingleton();
        $conn = $app->conexionBd();
    $query = sprintf("DELETE FROM contrato_adopcion WHERE DNI = '%s' AND ID = '%s'", $dniUsuario, $idAnimal);
    $result = $conn->query($query);
    if (!$result) {
      error_log($conn->error);
    } else if ($conn->affected_rows != 1) {
      error_log("Se han borrado '$conn->affected_rows' !");
    }

    return $result;
}

/**
 * save or update a contract
 */ 
 
public function guarda()
  {
    if (!self::buscaPorDNIeID($this->dni,$this->id)) {
      self::insertaContrato($this);
    } else {
      self::actualizaContrato($this);
    }
    return $this;
  }

public function ComprobarEnProceso()
{
	return $this->estado == "EnTramite";
}
/*
public static function getSolicitudes()
 {
	 $solicitudes = array();
	 $conn = getConexionBD();
	 $query = sprintf("SELECT DNI, ID FROM contrato_adopcion"); 
	 $rs = $conn->query($query);
	 
	 for($i = 0; $i < $rs->num_rows*2; $i+=2){
           $fila = $rs->fetch_assoc();
		   $solicitudes[$i] = $fila['DNI'];
		   $solicitudes[$i+1] = $fila['ID'];
	 }
	 $rs->free();
	 
	 return $solicitudes;
 }
*/
public static function getSolicitudes()
 {
       $app = es\ucm\fdi\aw\Aplicacion::getSingleton();
        $conn = $app->conexionBd();
         $query = sprintf("SELECT * FROM contrato_adopcion ORDER BY fecha DESC"); 
         $rs = $conn->query($query);
         if($rs && ($rs->num_rows >0)){
            $resultado = [];
            while($fila=$rs->fetch_assoc()){
               $contrato = new Contrato($fila['DNI'], $fila['ID'], 
               $fila['formulario'], $fila['estado'], $fila['fecha']);
               array_push($resultado, $contrato);              
            }
			 $rs->free();
            return $resultado;
         }
		 $rs->free();
        return false; 
 }
}
