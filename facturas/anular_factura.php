<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_anular_factura = "update  $tabla11 set anulado = '1'  where id_factura = '".$_GET['id_factura']."' ";
//echo $sql_anular_factura ;
$consulta_anular = mysql_query($sql_anular_factura,$conexion);

///ahora se debe colocar el estado de la orden nuevamente para que se pueda modificar
$sql_traer_id_orden = "select id_orden from $tabla11 where  id_factura = '".$_GET['id_factura']."' ";
$consulta_id_orden = mysql_query($sql_traer_id_orden,$conexion);
$id_orden = mysql_fetch_assoc($consulta_id_orden);

//echo '<br>id_orden = <br>'.$id_orden['id_orden'];

$sql_cambiar_estado_orden = "update $tabla14 set estado = '0'  where id = '".$id_orden['id_orden']."' ";
$consulta_cambiar_estado_orden = mysql_query($sql_cambiar_estado_orden,$conexion);
//anular el registro de movimientos de inventario
$sql_anular_registro_movimientos_inventario = "update $tabla19 set anulado = '1'  where id_factura_venta = '".$_GET['id_factura']."'    ";
$consulta_anulacion = mysql_query($sql_anular_registro_movimientos_inventario,$conexion);

echo '<h1>FACTURA_ANULADA</h1>';
echo '<br>';
include('../colocar_links2.php');
?>