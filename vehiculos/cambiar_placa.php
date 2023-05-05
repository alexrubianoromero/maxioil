<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/

	
$sql_cambio_placa = "update $tabla4 set placa = '".$_REQUEST['nueva_placa']."'  where idcarro = '".$_REQUEST['idcarro']."' "; 
$sql_cambio_orden = "update $tabla14  set placa = '".$_REQUEST['nueva_placa']."'  where placa = '".$_REQUEST['placa_anterior']."'  
and id_empresa = '".$_SESSION['id_empresa']."' "; 
$sql_cambira_factura = "update $tabla11 set placa ='".$_REQUEST['nueva_placa']."'  where placa = '".$_REQUEST['placa_anterior']."'  and id_empresa = '".$_SESSION['id_empresa']."'";

/*
echo '<br>'.$sql_cambio_placa;
echo '<br>'.$sql_cambio_orden;
echo '<br>'.$sql_cambira_factura;
*/
if($_REQUEST['nueva_placa']=='')
	{ echo '<br><br>valores en blanco en nueva placa no es posible realizar el ambio';}
else	
{
	$consulta_cambio_carros = mysql_query($sql_cambio_placa,$conexion);
	$consulta_cambio_ordenes = mysql_query($sql_cambio_orden,$conexion);
	$consulta_cambio_facturas = mysql_query($sql_cambira_factura,$conexion);
   echo '<BR><br>ACTUALIZACION REALIZADA';
}

?>
