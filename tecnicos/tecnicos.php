<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once('../valotablapc.php');  
require_once('../tecnicos/controlador/TecnicosController.php'); 
$tecnicos = new TecnicosController();
$tecnicos->traerTecnicos($conexion);
?>