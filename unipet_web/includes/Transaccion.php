<?php

class Transaccion
{	
    public static function buscaPorTarjeta($tarjeta)
    {
	   $app = Aplicacion::getSingleton();
       $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM transacciones WHERE ID='%s' ", $tarjeta); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $user = new Transaccion($fila['ID'], $fila['ID_usuario'], $fila['tarjeta'], $fila['cantidad']);
        $rs->free();
        return $user;
       }
       return false;
    }
	
    public static function ordenaPorFecha()
    {
	   $app = Aplicacion::getSingleton();
       $conn = $app->conexionBd();
       $query = sprintf("SELECT * FROM transacciones ORDER BY ID"); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $user = new Transaccion($fila['ID'], $fila['ID_usuario'], $fila['tarjeta'], $fila['cantidad']);
        $rs->free();
        return $user;
       }
       return false;
    }

    public static function register($usuario, $cantidad, $numero_tarjeta)
    {	
		//Guardamos $protectora como la fecha-h-m-s-microsegundo(6 decimales)
		$date = DateTime::createFromFormat('U.u', microtime(TRUE));
		$protectora = $date->format('YmdHisu');

		$user = new Transaccion($protectora, $usuario, $numero_tarjeta, $cantidad);
		return self::inserta($user);
    }
    
    private static function inserta($transaccion)
    {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $query=sprintf("INSERT INTO transacciones (ID, ID_usuario, tarjeta, cantidad)
			VALUES('%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($transaccion->ID)
            , $conn->real_escape_string($transaccion->ID_usuario)
            , $conn->real_escape_string($transaccion->tarjeta)
            , $conn->real_escape_string($transaccion->cantidad));
        if ( $conn->query($query) ) {
            $transaccion->ID = $conn->insert_ID;
		}
		else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $transaccion;
    }
    
	public static function actualiza($usuario, $ID, $cantidad, $numero_tarjeta){
        $ap = new Transaccion($ID, $usuario, $numero_tarjeta, $cantidad);
        return $ap;
    }
	
    public static function actualizaTransaccion($transaccion)
	{
		$result = false;

		$app = Aplicacion::getSingleton();
			$conn = $app->conexionBd();
		  $query = sprintf("UPDATE transaccions SET  ID = '%s', ID_usuario = '%s', tarjeta = %d, cantidad = '%s'"
		  , $transaccion->ID
		  , $transaccion->ID_usuario
		  , $transaccion->numero_tarjeta
		  , $transaccion->cantidad;
		$result = $conn->query($query);
		if (!$result) {
		  error_log($conn->error);  
		} else if ($conn->affected_rows != 1) {
		  error_log("Se han actualizado los datos '$conn->affected_rows' !");
		}
		return $result;
	}    


	private $ID_usuario;
	private $ID;
	private $cantidad;
	private $numero_tarjeta;

	private function __construct($protectora, $usuario, $tarjeta, $cantidad)
	{
		$this->ID_usuario = $usuario;
		$this->ID = $protectora;
		$this->cantidad = $cantidad;
		$this->numero_tarjeta = $tarjeta;
	}

	/**
	 * Get the value of ID_usuario
	 */ 
	public function getID_usuario()
	{
	return $this->ID_usuario;
	}
	/**
	 * Get the value of ID
	 */ 
	public function getID()
	{
	return $this->ID;
	}
	/**
	 * Get the value of cantidad
	 */ 
	public function getCantidad()
	{
	return $this->cantidad;
	}
	/**
	 * Get the value of num tarjeta
	 */ 
	public function getNumTarjeta()
	{
	return $this->numero_tarjeta;
	}
}