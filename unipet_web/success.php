<?php

require_once __DIR__.'/includes/FormularioApadrina.php';
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Success';

$contenidoPrincipal = <<<EOS
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TRANSACCIÓN REALIZADA CON ÉXITO</title>
    <link rel="shortcut icon" href="../../favicon.ico">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<bodyy>
    <p>TRANSACCIÓN REALIZADA CON ÉXITO</p>
</bodyy>
EOS;

require __DIR__.'/includes/plantillas/plantillaApadrina.php';