<?php

namespace es\ucm\fdi\aw;
require_once ("includes/usuarioUtils.php");

class FormularioInforma extends Form
{
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
	    	$html = <<<EOS
					<fieldset>
					<legend>Haganos saber cosas que nos tenga que comunicar urgentemente</legend>
					  <div>
						<input type="text" name="informacion" size="100"/>
					  </div>
					  <div>
						<input type="submit" name="submit" value="Send" />
						<input type="reset" name="reset" value="Clear" />
					  </div>
					</fieldset>
EOS;
			return $html;
    }
    

    protected function procesaFormulario($datos) {
		
		$result = array();
		
        $informacion = $datos['informacion'] ?? null;
		
		$comentario = Colabora::add(idUsuarioLogado(), $informacion);
		Colabora::inserta($comentario);
		$result = 'index.php';
		
		return $result;
	}
}