<?php
// echo  '<pre>';
// print_r($_REQUEST);
// echo  '</pre>';
date_default_timezone_set('America/Bogota');
require_once('../valotablapc.php'); 
require_once('controlador/ordenControlador.php');
$controlador = new ordenControlador($conexion);
?>