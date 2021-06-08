<?php

require_once __DIR__.'/includes/config.php';

$form = new es\ucm\fdi\aw\FormularioDona("1");
$htmlFormDona = $form->gestiona();

$tituloPagina = 'Dona';

$contenidoPrincipal = <<<EOS
        <h2>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
			<span>&nbsp&nbsp</span>
            <span>D</span>
            <span>O</span>
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
$htmlFormDona
EOS;

require __DIR__.'/includes/plantillas/plantillaDona.php';