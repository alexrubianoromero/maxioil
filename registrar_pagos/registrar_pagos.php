<?php
session_start();
include('../valotablapc.php');
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';


$sql_grabar_pago = "update $tabla15  set pagado= 1 where  id_item = '".$_REQUEST['id_item']."'  ";
$consulta_registro = mysql_query($sql_grabar_pago,$conexion);

?>