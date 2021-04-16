<?php

require_once __DIR__.'/config.php';


class Usuario
{
    public static function buscaPorDNI($dniUsuario)
    {
       $conn = getConexionBD();
       $query = sprintf("SELECT * FROM Usuarios WHERE DNI='%s' ", $dniUsuario); 
       $rs = $conn->query($query);
       if($rs && $rs->num_rows == 1){
           $fila = $rs->fetch_assoc();
           $user = new Usuario($fila['DNI'], $fila['nombre'], 
                                $fila['apellido'], $fila['telefono'], $fila['email'],
                                $fila['contraseña'], $fila['nacimiento'], 
                                $fila['nacimiento'], $fila['direccion'], $fila['tipo']);
        $rs->free();
        return $user;
       }
       return false;
    }



private $dni;
private $nombre;
private $apellido;
private $telefono;
private $email;
private $contraseña;
private $nacimiento;
private $direccion;
private $tipo;

private function __construct($dni, $nombre, $apellido, $telefono,
                             $email, $contraseña, $nacimiento, $direccion , $tipo)
{
    $this->dni = $dni;
    $this->nombre = $nombre;
    $this->apellido = $apellido;
    $this->telefono = $telefono;
    $this->email = $email;
    $this->contraseña = $contraseña;
    $this->nacimiento = $nacimiento;
    $this->direccion = $direccion;
    $this->tipo = $tipo;
}

 
public function compruebaContraseña($contraseña){
    return password_verify($contraseña, $this->contraseña);
}

/**
 * Get the value of tipo
 */ 
public function getTipo()
{
return $this->tipo;
}

/**
 * Get the value of dni
 */ 
public function getDni()
{
return $this->dni;
}

/**
 * Get the value of nombre
 */ 
public function getNombre()
{
return $this->nombre;
}

/**
 * Get the value of apellido
 */ 
public function getApellido()
{
return $this->apellido;
}

/**
 * Get the value of telefono
 */ 
public function getTelefono()
{
return $this->telefono;
}

/**
 * Get the value of email
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Get the value of nacimiento
 */ 
public function getNacimiento()
{
return $this->nacimiento;
}

/**
 * Get the value of direccion
 */ 
public function getDireccion()
{
return $this->direccion;
}


/**
 * Set the value of telefono
 *
 * @return  self
 */ 
public function setTelefono($telefono)
{
$this->telefono = $telefono;

return $this;
}

/**
 * Set the value of email
 *
 * @return  self
 */ 
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Set the value of direccion
 *
 * @return  self
 */ 
public function setDireccion($direccion)
{
$this->direccion = $direccion;

return $this;
}
}