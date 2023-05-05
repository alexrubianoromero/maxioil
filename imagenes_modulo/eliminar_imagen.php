<?php
session_start();
include('../valotablapc.php');  
unlink($_REQUEST['ruta_imagen']);

$sql_eliminar_registro = "delete from $tablaima where id_imagen_orden = '".$_REQUEST['id_imagen_orden']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar_registro,$conexion);
echo '<br><br><br>';
echo 'IMAGEN BORRADA';
echo '<br><br>'; 
echo '<a href="muestre_imagenes_orden.php?idorden='.$_REQUEST['idorden'].'">VOLVER A IMAGENES ORDEN</a>';


?>

