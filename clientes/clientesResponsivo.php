<?php
session_start();
date_default_timezone_set('America/Bogota');
$raiz = dirname(dirname(__file__));
require_once($raiz.'/valotablapc.php');  
require_once($raiz.'/funciones.php'); 
require_once($raiz.'/clientes/controlador/ClientesControlador.php');
$cliente = new ClientesControlador($conexion);
?>