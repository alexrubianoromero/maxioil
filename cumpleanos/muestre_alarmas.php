<?php
session_start();
date_default_timezone_set('America/Bogota');
include('../valotablapc.php');
include('../funciones_alarmas.php');
$fechapan =  time();



echo '<h2>ALARMAS</h2>';

$alertas = verificar_alertas($fechapan,$cuentasxpagar,$conexion);

echo '<br><h3>FECHAS A VENCER  CUENTAS POR PAGAR  '.$alertas.'</h3>';

include('../alarmas/muestre_cxc.php');





?>