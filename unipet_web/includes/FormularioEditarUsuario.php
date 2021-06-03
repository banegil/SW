<?php
require_once "includes\Form.php";
require_once "UsuarioDB.php";
require_once "Usuario.php";


class FormularioEditarUsuario extends Form
{
    public function __construct() {
        parent::__construct('formEditUsuario');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        
        $user = Usuario::buscaPorDNI( idUsuarioLogado());
        $DNI = $user->getDni() ?? '';
		$nombre = $user->getnombre() ?? '';
		$apellido = $user->getApellido() ?? '';
		$telefono = $user->getTelefono() ?? '';
		$email = $user->getEmail() ?? '';
        $contraseña = $user->getContraseña();
		$nacimiento = $user->getNacimiento() ?? '';
		$direccion = $user->getDireccion() ?? '';

        // Se generan los mensajes de error si existen.
		/*
        $htmlErroresGlobales = self::generaListaErroresGlobales($errores);
        $errorDNI = self::createMensajeError($errores, 'DNI', 'span', array('class' => 'error'));
        $errorNombre = self::createMensajeError($errores, 'Nombre', 'span', array('class' => 'error'));
        $errorApellido = self::createMensajeError($errores, 'Apellido', 'span', array('class' => 'error'));
        $errorTelefono = self::createMensajeError($errores, 'Teléfono', 'span', array('class' => 'error'));
		$errorEmail = self::createMensajeError($errores, 'E-mail', 'span', array('class' => 'error'));
		$errorContraseña = self::createMensajeError($errores, 'Contraseña', 'span', array('class' => 'error'));
		$errorContraseña2 = self::createMensajeError($errores, 'Contraseña2', 'span', array('class' => 'error'));
		$errorNacimiento = self::createMensajeError($errores, 'Naciemiento', 'span', array('class' => 'error'));
		$errorDireccion = self::createMensajeError($errores, 'Direccion', 'span', array('class' => 'error'));
		*/
        $html = <<<EOF
            <fieldset>
                    <label>DNI:</label> <input class="control" type="text" name="DNI" value="$DNI" readonly/>
                    <label>Nombre:</label> <input class="control" type="text" name="nombre" value="$nombre"required/>
                    <label>Apellido:</label> <input class="control" type="text" name="apellido" value="$apellido" required/>
                    <label>Teléfono:</label> <input class="control" type="number" name="telefono" value="$telefono"required/>
                    <label>E-mail:</label> <input class="control" type="email" name="e-mail" value="$email"/>
                    <label>Contraseña:</label> <input class="control" type="password" name="contraseña" required/>
                    <label>Vuelve a introducir la contraseña:</label> <input class="control" type="password" name="contraseña2" required/>
                    <label>Fecha de Naciemiento:</label> <input class="control" type="date" name="nacimiento" value="$nacimiento"/>
                    <label>Dirección:</label> <input class="control" type="text" name="direccion" value="$direccion" required/>
                <div class="grupo-control"><button type="submit" name="actualizar">Actualizar</button></div>
            </fieldset>
EOF;
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $result = array();
        $DNI = $datos['DNI'] ?? null;
		$letra = substr($DNI, -1);
		$numeros = substr($DNI, 0, -1);
		
		//$DNI = $datos['DNI'] ?? null;
		if (empty($DNI) || substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra || strlen($letra) != 1 || strlen ($numeros) != 8 ){
			$result['DNI'] = "El DNI tiene que tener 8 números y una letra al final.";
		}
        
        $nombre = $datos['nombre'] ?? null;
        if ( empty($nombre) || mb_strlen($nombre) < 2 ) {
            $result['nombre'] = "El nombre tiene que tener una longitud de al menos 2 caracteres.";
        }
		
		$apellido = $datos['apellido'] ?? null;
        if ( empty($apellido) || mb_strlen($apellido) < 2 ) {
            $result['apellido'] = "El apellido tiene que tener una longitud de al menos 2 caracteres.";
        }
		
		$telefono = $datos['telefono'] ?? null;
        if ( empty($telefono) || mb_strlen($telefono) != 9 ) {
            $result['telefono'] = "El teléfono tiene que tener una longitud de 9 números.";
        }
		
		// El e-mail ya viene filtrado por type="email"
		$email = $datos['e-mail'] ?? null;
		
		$contraseña = $datos['contraseña'] ?? null;
        if ( empty($contraseña) || mb_strlen($contraseña) < 5 ) {
            $result['contraseña'] = "La contraseña tiene que tener una longitud de al menos 5 caracteres.";
        }
        $contraseña2 = $datos['contraseña2'] ?? null;
        if ( empty($contraseña2) || strcmp($contraseña, $contraseña2) !== 0 ) {
            $result['contraseña2'] = "Las contraseñas deben coincidir";
        }
		
		// La fecha de naciemiento ya viene filtrada por type="date"
		$nacimiento = $datos['nacimiento'] ?? null;
		
		$direccion = $datos['direccion'] ?? null;
        if ( empty($direccion) || mb_strlen($direccion) < 5 ) {
            $result['direccion'] = "La direccion tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        if (count($result) === 0) {
            $user = Usuario::actualiza($DNI, $nombre, $apellido, $telefono, $email, $contraseña, $nacimiento, $direccion);
            if ( ! $user ) {
                $result[] = "El usuario ya existe";
            } else {
                $result = 'login.php';
            }
        }
        return $result;
    }
}