<?php
session_start();
include('../valotablapc.php');

$sql_grabar_anotacion  ="insert into $anotaciones_inventario  (fecha,nombre_pieza,cantidad)  

values('".$_REQUEST['fecha']."'

      ,'".$_REQUEST['nombre_pieza']."'
      ,'".$_REQUEST['cantidad']."'
	) ";
//echo  '<br>'.$sql_grabar_anotacion;
$consulta_grabar = mysql_query($sql_grabar_anotacion,$conexion);

echo 'ANOTACION GRABADA ';

?>