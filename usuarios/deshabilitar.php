<?php
session_start();
include('../valotablapc.php');

$sql_deshabilitar = "update $tabla16  set  activo = '0'  where id_usuario = '".$_REQUEST['id_usuario']."' ";
//echo '<br>'.$sql_deshabilitar;
$consulta_des= mysql_query($sql_deshabilitar,$conexion);

echo 'Se deshabilito el usuario solicitado ';

?>