<?php
session_start();
date_default_timezone_set('America/Bogota');
require_once('../valotablapc.php');  
require_once('../empresa/controlador/EmpresaController.php'); 
$empresa = new EmpresaController();
// $empresa->traerInfoEmpresa();
$empresa->pruebaEmpresa();

?>