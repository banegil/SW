<?php

require_once __DIR__.'/config.php';

class Protectora
    {
		public static function add($id, $nombre, $direccion, $telefono)
		{	
		   $protectora = new Protectora($id, $nombre, $direccion, $telefono);   
		   return $protectora;
		}
		
        public static function buscaProtectoraPorId($id){
			$app = Aplicacion::getSingleton();
			$conn = $app->conexionBd();
            $query = sprintf("SELECT * FROM Protectoras WHERE id='%s' ", $id); 
            $rs = $conn->query($query);
            if($rs && $rs->num_rows == 1){
                $fila = $rs->fetch_assoc();
               
                $user = new Protectora($id, $fila['nombre'], 
                                     $fila['direccion'], $fila['telefono']
                                    );
             $rs->free();
             return $user;
            }
            return false;
        }

		public static function getProtectoras()
		{
			$app = Aplicacion::getSingleton();
			$conn = $app->conexionBd();
			$query = sprintf("SELECT * FROM Protectoras ORDER BY ID ASC"); 
			$rs = $conn->query($query);
			if($rs && ($rs->num_rows >0)){
				$resultado = [];
				while($fila=$rs->fetch_assoc()){
					$protectora = new Protectora($fila['ID'], $fila['nombre'], 
					$fila['direccion'], $fila['telefono']);
					array_push($resultado, $protectora);              
				}
				$rs->free();
				return $resultado;
			}
			$rs->free();
			return false; 
		}
    
    
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;


    private function __construct($id, $nombre, $direccion, $telefono){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
    
	public static function insertaProtectora($protectora)
{
	$result = false;

	$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
		
	$query = "INSERT INTO protectoras (ID, nombre, direccion, telefono)
		VALUES ($protectora->id, '$protectora->nombre', $protectora->direccion, '$protectora->telefono')";
		$result = $conn->query($query);
		
		if ($result) {
		  $result = $protectora;
		} else {

		  error_log($conn->error); 
		}
		
		return $result;
}

/**
 * update protectora
 */ 
  
public static function actualizaProtectora($protectora)
{
	$result = false;

	$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
	$query = sprintf("UPDATE protectoras SET  nombre = %s, direccion = '%s', telefono = '%s' WHERE ID = %d"

		  , $protectora->nombre
		  , $protectora->direccion
		  , $protectora->telefono);

		$result = $conn->query($query);
		if (!$result) {
		  error_log($conn->error);  
		} else if ($conn->affected_rows != 1) {
		  error_log("Se han actualizado los datos '$conn->affected_rows' !");
		}
	return $result;
}
	
	
	
	
    /**
     * Get the value of id
     */ 
    public function getID()
    {
        return $this->id;
    }
    

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }
	
	public function guarda()
	{
		if (!self::buscaProtectoraPorId($this->id)) {
		  self::insertaProtectora($this);
		} else {
		  self::actualizaProtectora($this);
		}

		return $this;
	}
    }


