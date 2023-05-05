<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $tabla16 (login,nombre,id_empresa_externa,idempresa,clave,id_perfil)

values(
'".$_REQUEST['login']."'
,'".$_REQUEST['nombre']."'
,'".$_REQUEST['id_empresa_externa']."'
,'300'
,'".$_REQUEST['clave']."'
,'13'
)
";
//echo  '1231231231231231232<br>'.$sql_grabar;
//exit();
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
