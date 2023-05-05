<?php
session_start();
include('../valotablapc.php');

$sql_anular = "update $tabla14   set anulado = '1'  , estado = '50'  where id = '".$_REQUEST['idorden']."'    ";
//echo  '<br>'.$sql_anular;
$consulta_anular = mysql_query($sql_anular,$conexion);

echo '<h2>Orden Anulada</h2>';

?>