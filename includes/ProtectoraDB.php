<?php

require_once __DIR__.'/config.php';

class Protectora
    {
        public static function buscaProtectoraPorId($id){
            $conn = getConexionBD();
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
    }


