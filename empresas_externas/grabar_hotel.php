<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $empresas_externas (nombre_empresa,telefono,direccion,email)

values(
'".$_REQUEST['nombre_producto']."'
,'".$_REQUEST['telefono_producto']."'
,'".$_REQUEST['direccion_producto']."'
,'".$_REQUEST['email_producto']."'

	);
";
//echo  '<br>'.$sql_grabar;
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
