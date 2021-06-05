<?php
require_once __DIR__.'/config.php';
class Hilo
{
	private $id;
	private $titulo;
	private $fecha;
	private $id_usuario;
	private $comentario;
	
	private function __construct($id, $titulo, $fecha, $id_usuario, $comentario)
	{
		$this->id = $id;
		$this->titulo = $titulo;
		$this->fecha = $fecha;
		$this->id_usuario = $id_usuario;
		$this->comentario = $comentario;
	}
	
	public static function getHilos(){
		$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM hilos"); 
		$rs = $conn->query($query);
		if($rs && ($rs->num_rows >0)){
			$resultado = array();
			while($fila=$rs->fetch_assoc()){
				$hilo = new Hilo($fila['NUMERO'], $fila['titulo'], $fila['fecha'], $fila['ID_usuario'], $fila['comentario']);
				array_push($resultado, $hilo);
			}   
			$rs->free();
			return $resultado;
		}
		return false;     
	}
		
	public function getID()
	{
		return $this->id;
	}
	public function getTitulo()
	{
		return $this->titulo;
	}
	public function getFecha()
	{
		return $this->fecha;
	}
	public function getID_usuario()
	{
		return $this->id_usuario;
	}
	public function getComentario()
	{
		return $this->comentario;
	}
	public function setTitulo($titulo)
	{
		$this->id = $titulo;
		return true;
	}
	public function setComentario($comentario)
	{
		$this->comentario = $comentario;
		return true;
	}
}
