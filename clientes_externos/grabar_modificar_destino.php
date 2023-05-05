<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $tabla16 
set nombre = '".$_REQUEST['nombre']."' ,
login = '".$_REQUEST['login']."'
, id_empresa_externa = '".$_REQUEST['id_empresa']."'  

, clave = '".$_REQUEST['clave']."' 

 where id_usuario = '".$_REQUEST['id_usuario']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 

echo 'MODIFICADO OK';
include('../clientes_externos/mostrar_hoteles.php');



?>