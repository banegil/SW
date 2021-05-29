<?php

class Foro
{

   public static function getHilos(){
		$app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
		$query = sprintf("SELECT titulo, comentario, NUMERO FROM hilos"); 
		$rs = $conn->query($query);
		if($rs && ($rs->num_rows >0)){
			$resultado = array();
			while($fila=$rs->fetch_assoc()){
			   array_push($resultado, $fila['titulo']);
			   array_push($resultado, $fila['comentario']);
			   array_push($resultado, $fila['NUMERO']);
			}
			$rs->free();           
			return $resultado;
		}
		$rs->free();
		return false;     
	}
  
}