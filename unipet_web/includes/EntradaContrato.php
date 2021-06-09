<?php
namespace es\ucm\fdi\aw;

class EntradaContrato
{
	private $id;
	private $id_usuario;
	private $id_animal;
	private $comentario;
	private $fecha;
	
	private function __construct($id,$id_usuario, $id_animal, $comentario, $fecha)
	{
		$this->id = $id;
		$this->id_usuario = $id_usuario;
		$this->id_animal = $id_animal;
		$this->comentario = $comentario;
		$this->fecha = $fecha;
	}
	
	public static function getEntradasPorContrato($id_animal,$id_usuario){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM entradascontrato WHERE ID_usuario = %d AND ID_animal=%d ORDER BY fecha ASC",$id_usuario,$id_animal); 
		$rs = $conn->query($query);
		if($rs && ($rs->num_rows >0)){
			$resultado = array();
			while($fila=$rs->fetch_assoc()){
				$hilo = new EntradaContrato($fila['ID'],$fila['ID_usuario'], $fila['ID_animal'], $fila['comentario'], $fila['fecha']);
				array_push($resultado, $hilo);
			}   
			$rs->free();
			return $resultado;
		}
		return false;     
	}
	
	public static function nuevaEntradaContrato($id_usuario,$id_animal,$comentario,$fecha){
		$existeContrato = Contrato::buscaPorIDeID($id_usuario, $id_animal);
		$existeUsuario = Usuario::buscaPorID_usuario($id_usuario);
		//if (!$existeContrato || !$existeUsuario) return false;
		return self::inserta(new EntradaContrato(0,$id_usuario,$id_animal,$comentario,$fecha));
	}
	
	public static function inserta($entrada){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("INSERT into entradascontrato(ID_usuario, ID_animal, comentario, fecha) VALUES (%d, %d, '%s', '%s')", $entrada->id_usuario, 
																													$entrada->id_animal, 
																													$conn->real_escape_string($entrada->comentario),
																									$entrada->fecha); 
																									echo "$query";
		if ( $conn->query($query) ) {
            $entrada->id = $conn->insert_id;
		}
		else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return true;		
	}
	
	public function getID()
	{
		return $this->id;
	}
		
	public function getID_usuario()
	{
		return $this->id_usuario;
	}
	
	public function getID_animal()
	{
		return $this->id_animal;
	}
	
	public function getComentario()
	{
		return $this->comentario;
	}
	
	public function getFecha()
	{
		return $this->fecha;
	}
}