<?php
session_start();
include('../valotablapc.php');
$sql_anular_factura = "update $tabla11 set anulado = '1'  where id_factura = '".$_REQUEST['id_factura']."'  ";

echo '<br>'.$sql_anular_factura;
$consulta_factura = mysql_query($sql_anular_factura,$conexion);

echo '<br><br>';
echo '<h3>FACTURA ANULADA </h3>';




?>