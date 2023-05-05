<?php
include('../valotablapc.php');  
session_start();
$sql_eliminar_codigo = "delete from $tabla12     where id_codigo =  '".$_REQUEST['id_codigo']."'  ";
$consulta_eliminar = mysql_query($sql_eliminar_codigo,$conexion);



echo '<BR><BR>CODIGO ELIMINADO';
?>