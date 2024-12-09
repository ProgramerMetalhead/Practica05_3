<?php

// Para importar otro archivo de código PHP
require_once "config.php";
require APP_PATH . "services/session_requerida.php";

// Diferentes tipos de variables
$tituloPagina = "Práctica 05-3 - Server Side Programming";  // variable string
$hoy = new DateTime("now");  // variable DateTime (object)
$numeroEnter = 100;  // variable int
$numeroDecimal = 3.14159;  // variable float
$valorBooleano = true;  // variable boolean

// Cookies para obtener la cantidad de visitas a la págnia.
$cantidadVisitas = 1;
$segundosEnUnDia = 86400;
$expira = time() + ($segundosEnUnDia * 30);  // tiempo en que expira, 30 día a partir de hoy
if (isset($_COOKIE["cantidadVisitas"])) {  // ya existe la cookie?
    $cantidadVisitas = (int)$_COOKIE["cantidadVisitas"];  // se obtiene el valor (que es un string)
    $cantidadVisitas++; 
}

// Para establecer la cookie (esta irá en el response)
setcookie(
    "cantidadVisitas",  // nombre de la cookie
    (string)$cantidadVisitas,  // valor de la cookie
    $expira   // cuándo exipira (fecha UNIX)
);

// Se regresa el view  del index  :)
require APP_PATH . "views/index.view.php";
