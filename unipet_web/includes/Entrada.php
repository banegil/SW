<?php
namespace es\ucm\fdi\aw;

class Entrada
{
	private $id_usuario;
	private $numero;
	private $id_hilo;
	private $comentario;
	private $fecha;
	
	private function __construct($id_usuario, $numero, $id_hilo, $comentario, $fecha)
	{
		$this->id_usuario = $id_usuario;
		$this->numero = $numero;
		$this->id_hilo = $id_hilo;
		$this->comentario = $comentario;
		$this->fecha = $fecha;
	}
	
	public static function getEntradasPorHilo($id_hilo){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM entradas WHERE hilo = %d ORDER BY fecha DESC",$id_hilo); 
		$rs = $conn->query($query);
		if($rs && ($rs->num_rows >0)){
			$resultado = array();
			while($fila=$rs->fetch_assoc()){
				$hilo = new Entrada($fila['ID_usuario'], $fila['numero'], $fila['hilo'], $fila['comentario'], $fila['fecha']);
				array_push($resultado, $hilo);
			}   
			$rs->free();
			return $resultado;
		}
		return false;     
	}
		
	public function getID_usuario()
	{
		return $this->id_usuario;
	}
	public function getNumero()
	{
		return $this->numero;
	}
	public function getFecha()
	{
		return $this->fecha;
	}
	public function getID_hilo()
	{
		return $this->hilo;
	}
	public function getComentario()
	{
		return $this->comentario;
	}
	public function setComentario($comentario)
	{
		$this->comentario = $comentario;
		return true;
	}
}