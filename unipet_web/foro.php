<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/comun/listaHilos.php';
require_once ("includes/usuarioUtils.php");

$tituloPagina = 'Foro';
$hilos = listaHilos(es\ucm\fdi\aw\Hilo::getHilos());
$formNuevoForo="";
if(estaLogado()){
$form=new es\ucm\fdi\aw\FormularioHilo(idUsuarioLogado());	
$formNuevoForo=$form->gestiona();
}

$contenidoPrincipal = <<<EOS
$hilos
$formNuevoForo
EOS;

require __DIR__.'/includes/plantillas/plantilla.php';
