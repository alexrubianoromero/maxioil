<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $tabla16 where id_usuario = '".$_REQUEST['id_hotel']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>