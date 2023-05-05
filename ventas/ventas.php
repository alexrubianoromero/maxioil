<?php
// session_start();
date_default_timezone_set('America/Bogota');
$raiz = dirname(dirname(__file__));
// echo $raiz;

//  die();

require_once($raiz.'/ventas/controllers/ventasController.php');
$ventas = new ventasController();
?>


