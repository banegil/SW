<?php

namespace es\ucm\fdi\aw;

class FormularioColabora extends Form
{
    public function __construct() {
        parent::__construct('formColabora');
    }
    
    protected function generaCamposFormulario($datos, $errores = array())
    {
	    	$html = <<<EOS
					<fieldset>
            <legend>Cómo colaborar con nosotros</legend>
			<form action="mailto:unipetcontact@gmail.com" method="get" enctype="text/plain">
				  <div>
					<p><label></label> <input type="text" name="comoColaborar"/></p>
				  </div>
				  <div>
					<p><label>E-mail</label> <input type="email" name="email" /></p>
				  </div>
				  <div>
					<p><label>Nombre</label> <input type="text" name="nombre" /></p>
				  </div>
				  <div>
					<p><label>Apellidos</label> <input type="text" name="apellidos" /></p>
				  </div>
				  <div>
					<input type="submit" name="submit" value="Send" />
					<input type="reset" name="reset" value="Clear" />
				  </div>
			</form>
					</fieldset>
EOS;
			return $html;
    }
    

    protected function procesaFormulario($datos) {
		return 'colabora.php';
	}
}
