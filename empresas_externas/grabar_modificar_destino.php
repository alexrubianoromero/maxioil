<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $hoteles 
set nombre = '".$_REQUEST['nombre']."' 

, id_destino = '".$_REQUEST['id_destino']."'  

 where id_hotel = '".$_REQUEST['id_hotel']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>