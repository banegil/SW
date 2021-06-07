<?php

require_once __DIR__.'/includes/FormularioApadrina.php';
require_once __DIR__.'/includes/config.php';

$form = new FormularioApadrina("1");
$htmlFormApadrina = $form->gestiona();

$tituloPagina = 'Apadrina';

$contenidoPrincipal = <<<EOS
        <h2>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
            <span>A</span>
            <span>P</span>
            <span>A</span>
            <span>D</span>
            <span>R</span>
            <span>I</span>
            <span>N</span>
            <span>A</span>
			<span>&nbsp&nbsp</span>
            <span>C</span>
            <span>O</span>
            <span>N</span>
            <span>&nbsp&nbsp</span
            <span>U</span>
            <span>N</span>
            <span>I</span
            <span>P</span>
            <span>E</span>
            <span>T</span>
        </h2>
$htmlFormApadrina
EOS;

require __DIR__.'/includes/plantillas/plantillaApadrina.php';