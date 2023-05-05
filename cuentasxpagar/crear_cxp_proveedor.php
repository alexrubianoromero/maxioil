<?php
session_start();
include("../valotablapc.php");
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_cxp = "insert into $cuentasxpagar (id_proveedor,factura_compra, valor_factura,fecha_vencimiento,observaciones,saldo)  

 values(
'".$_REQUEST['id_proveedor']."'
,'".$_REQUEST['facturacompra']."'
,'".$_REQUEST['valor_factura']."'
,'".$_REQUEST['fecha_vencimiento']."'
,'".$_REQUEST['observaciones']."'
,'".$_REQUEST['valor_factura']."'

 	)";
//echo '<br>'.$sql_cxp;
$consulta_grabarcxp = mysql_query($sql_cxp,$conexion);

echo 'SE CREO LA CUENTA POR PAGAR  PARA ESTE PROVEEDOR ';
?>
