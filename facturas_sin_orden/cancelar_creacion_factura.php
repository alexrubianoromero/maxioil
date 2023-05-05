<?php
session_start();
include('../valotablapc.php');
include('../funciones.php'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
/////borrar la factura
///borrar los items de tabla 100
//devolver el contador
$numero_anterior = $_REQUEST['numero_factura'] -1;
//echo 'numero anterior=='.$numero_anterior;

$sql_borrar_factura = "delete from $tabla11 where id_factura = '".$_REQUEST['id_factura']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$sql_quitar_items  = "delete from $tabla100   where  no_factura =   '".$_REQUEST['id_factura']."'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$sql_devolver_numeracion = "update $tabla10   set contafac = '".$numero_anterior."' where   id_empresa = '".$_SESSION['id_empresa']."'";
/*
echo '<br>borrar factura<br> '.$sql_borrar_factura;
echo '<br>sql_quitar_items <br>'.$sql_quitar_items;
echo '<br>sql_devolver_numeracion<br> '.$sql_devolver_numeracion;
*/

$consulta_borrar_factura = mysql_query($sql_borrar_factura,$conexion);
$consulta_quitar_items = mysql_query($sql_quitar_items,$conexion);
$consulta_devolver_numeracion = mysql_query($sql_devolver_numeracion,$conexion);


echo '<BR>SE HA CANCELADO LA CREACION DE ESTA FACTURA <br>';

include('../colocar_links2.php');


?>