<?php
require_once "includes\Form.php";

class FormularioApadrina extends Form
{
    public function __construct() {
        parent::__construct('formApadrina');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
        $numero_tarjeta = $datos['numero_tarjeta'] ?? null;
		$fecha_exp = $datos['fecha_exp'] ?? null;
		$cvv = $datos['cvv'] ?? null;
		$cantidad = $datos['cantidad'] ?? null;
		
        $html = <<<EOF
			</fieldset>
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>Ghost Text Animation</title>
					<link rel="shortcut icon" href="../../favicon.ico">
					<link rel="stylesheet" type="text/css" href="style.css" />
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title> Unipet </title>
				</head>
			
				<body class="active">
					<div class="floating">
					<div class="thickness"></div>
					<div class="thickness"></div>
					<div class="thickness"></div> 
					<div class="card_body">
					<div class="paypal_center svg"></div>
					<div class="logo svg"></div>
					<div class="paywave svg"></div>
					<div class="chips svg"></div>
					<div class="card_no text">
					<input class="control" type="tel" maxlength="16" placeholder="1234 1234 1234 1234" name="numero_tarjeta" value="$numero_tarjeta">
					</div>
					<div class="valid text">
					FECHA <br> EXP
					</div>
					<div class="valid_date text">
					<input class="control" type="text" maxlength="5" size=4 placeholder="7/10" name="fecha_exp" value="$fecha_exp">
					</div>
					<div class="cvv text">
					CVV
					</div>
					<div class="cvv_numero text">
					<input class="control" type="text" maxlength="3" size=4 placeholder="000" name="cvv" value="$cvv">
					</div>
					<div class="cantidad text">
					CANTIDAD MENSUAL:
					<input class="control" type="text" maxlength="3" size=4 placeholder="30€" name="cantidad" value="$cantidad">
					</div>
					<div class="mastercard_icon svg"></div>
					</div>
					</div>
					<div class="boton button"><button type="submit" name="registro">Apadrinar</button></div>
				</body>
			</fieldset>
EOF;
        return $html;
    }
    
    protected function procesaFormulario($datos)
    {
        $result = array();
		
		//Si no estan definidos salta warning
		$usuario = $_GET["ID_usuario"];	
		if ( empty($usuario) ){
			$result['usuario'] = "No hay usuario";
		}	
		$protectora = $_GET["ID_protectora"];
		if ( empty($animal) ){
			$result['protectora'] = "No hay protectora";
		}
		$animal = $_GET["ID_animal"];
		if ( empty($animal) ){
			$result['animal'] = "No hay animal";
		}	
		
        $numero_tarjeta = $datos['numero_tarjeta'] ?? null;
		if ( empty($numero_tarjeta) || !is_numeric($numero_tarjeta)) {
            $result['numero_tarjeta'] = "El número de tarjeta tiene que tener una longitud de 16 números (sin espacios).";
        }
		
		$fecha_exp = $datos['fecha_exp'] ?? null;
		$word = "/";
		if(empty($fecha_exp) || strpos($fecha_exp , $word) == false){
			$result['fecha_exp'] = "Error al introducir la fecha de expiración, vuelve a intentarlo";
		}
		
		$cvv = $datos['cvv'] ?? null;
		if ( empty($cvv) || !is_numeric($cvv) ) {
            $result['cvv'] = "Solo puedes introducir números en el campo CVV.";
        }
		
		$cantidad = $datos['cantidad'] ?? null;
		if ( empty($cantidad) || !is_numeric($cantidad)) {
            $result['cantidad'] = "Solo puedes introducir números en el campo Cantidad (sin el caracter €).";
        }
        
        if (count($result) === 0) {
            $userAnimal = Apadrinado::register($usuario, $animal, $cantidad, $numero_tarjeta);
            if ( ! $userAnimal ) {
                $result[] = "Hubo un error al insertar en la base de datos de Apadrinado, lo sentimos";
            } 
            $tarjeta = Tarjeta::register($usuario, $numero_tarjeta, $fecha_exp, $cvv);
            if ( ! $tarjeta ) {
                $result[] = "Hubo un error al insertar en la base de datos de Tarjeta, lo sentimos";
            }
            $transaccion = Transaccion::register($usuario, $cantidad, $numero_tarjeta);
            if ( ! $transaccion ) {
                $result[] = "Hubo un error al insertar en la base de datos de Transaccion, lo sentimos";
            }
			else {
                $result = 'success.php';
            }
        }
        return $result;
    }
}